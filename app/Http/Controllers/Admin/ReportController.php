<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Date Range Handling
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $selectedMovie = $request->input('movie_id');
        $selectedDirector = $request->input('director');

        // 2. Base Query for Confirmed Bookings
        $bookingsQuery = Booking::whereIn('status', ['confirmed', 'checked-in'])
            ->whereBetween('bookings.created_at', [$start, $end]);

        // Join to showtimes for filtering by movie or director easily
        $bookingsQuery->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
                      ->join('movies', 'showtimes.movie_id', '=', 'movies.id');

        if ($selectedMovie) {
            $bookingsQuery->where('movies.id', $selectedMovie);
        }
        if ($selectedDirector) {
            $bookingsQuery->where('movies.director', 'like', '%' . $selectedDirector . '%');
        }

        // --- A. Top-Level KPIs ---
        // Need to make sure we don't double count bookings if we change selects. So we clone.
        $kpiQuery = clone $bookingsQuery;
        
        // Sum total amount (we must distinct bookings here if we joined, but since showtimes are 1:1 to booking, no duplicate rows)
        $totalRevenue = $kpiQuery->sum('bookings.total_amount');
        
        // Count tickets (Bookings 1:M Tickets)
        $totalTickets = DB::table('tickets')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->whereIn('bookings.status', ['confirmed', 'checked-in'])
            ->whereBetween('bookings.created_at', [$start, $end])
            ->when($selectedMovie, fn($q) => $q->where('movies.id', $selectedMovie))
            ->when($selectedDirector, fn($q) => $q->where('movies.director', 'like', '%' . $selectedDirector . '%'))
            ->count('tickets.id');

        // --- B. Movie Performance (Daily Sales) ---
        // We want to list rows of Daily Sales per Movie
        $movieDailyQuery = DB::table('tickets')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->whereIn('bookings.status', ['confirmed', 'checked-in'])
            ->whereBetween('bookings.created_at', [$start, $end])
            ->when($selectedMovie, fn($q) => $q->where('movies.id', $selectedMovie))
            ->when($selectedDirector, fn($q) => $q->where('movies.director', 'like', '%' . $selectedDirector . '%'))
            ->select(
                DB::raw('DATE(bookings.created_at) as sale_date'),
                'movies.title as movie_title',
                'movies.director as director',
                DB::raw('COUNT(tickets.id) as ticket_count'),
                DB::raw('SUM(tickets.price) as revenue')
            )
            ->groupByRaw('DATE(bookings.created_at), movies.title, movies.director')
            ->orderBy('sale_date', 'desc')
            ->orderBy('revenue', 'desc');

        $moviePerformances = $movieDailyQuery->paginate(10, ['*'], 'perf_page');

        // --- C. Director Performance Leaderboard ---
        // Group by director
        $directorQuery = DB::table('tickets')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->whereIn('bookings.status', ['confirmed', 'checked-in'])
            ->whereBetween('bookings.created_at', [$start, $end])
            ->when($selectedMovie, fn($q) => $q->where('movies.id', $selectedMovie))
            ->select(
                'movies.director',
                DB::raw('COUNT(DISTINCT movies.id) as total_movies'),
                DB::raw('COUNT(tickets.id) as total_tickets'),
                DB::raw('SUM(tickets.price) as total_revenue')
            )
            ->groupBy('movies.director')
            ->orderBy('total_tickets', 'desc'); // Order by most viewers

        $directorPerformances = $directorQuery->get();

        // --- D. Chart Data (Overall Revenue Line Chart over Time) ---
        $chartLabels = [];
        $chartData = [];
        
        $revenueStats = DB::table('bookings')
            ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
            ->whereIn('bookings.status', ['confirmed', 'checked-in'])
            ->whereBetween('bookings.created_at', [$start, $end])
            ->when($selectedMovie, fn($q) => $q->where('movies.id', $selectedMovie))
            ->when($selectedDirector, fn($q) => $q->where('movies.director', 'like', '%' . $selectedDirector . '%'))
            ->selectRaw('SUM(bookings.total_amount) as total, DATE(bookings.created_at) as date')
            ->groupByRaw('DATE(bookings.created_at)')
            ->pluck('total', 'date')
            ->toArray();

        $diffInDays = $start->diffInDays($end);
        
        if ($diffInDays <= 60) {
            $period = \Carbon\CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $dateString = $date->format('Y-m-d');
                $chartLabels[] = $date->format('d M');
                $chartData[] = $revenueStats[$dateString] ?? 0;
            }
        } else {
            // Group by month for chart if range is huge
            $monthStats = DB::table('bookings')
                ->join('showtimes', 'bookings.showtime_id', '=', 'showtimes.id')
                ->join('movies', 'showtimes.movie_id', '=', 'movies.id')
                ->whereIn('bookings.status', ['confirmed', 'checked-in'])
                ->whereBetween('bookings.created_at', [$start, $end])
                ->when($selectedMovie, fn($q) => $q->where('movies.id', $selectedMovie))
                ->when($selectedDirector, fn($q) => $q->where('movies.director', 'like', '%' . $selectedDirector . '%'))
                ->selectRaw('SUM(bookings.total_amount) as total, DATE_FORMAT(bookings.created_at, "%Y-%m") as month_year')
                ->groupByRaw('DATE_FORMAT(bookings.created_at, "%Y-%m")')
                ->pluck('total', 'month_year')
                ->toArray();
                
            $current = $start->copy()->startOfMonth();
            $endMonth = $end->copy()->endOfMonth();
            
            while ($current <= $endMonth) {
                $key = $current->format('Y-m');
                $chartLabels[] = $current->format('M Y');
                $chartData[] = $monthStats[$key] ?? 0;
                $current->addMonth();
            }
        }

        // For Filter Dropdown
        $moviesList = Movie::select('id', 'title')->orderBy('title')->get();
        // Unique Directors
        $directorsList = Movie::select('director')->distinct()->whereNotNull('director')->pluck('director');

        return view('admin.reports.index', compact(
            'startDate',
            'endDate',
            'selectedMovie',
            'selectedDirector',
            'totalRevenue',
            'totalTickets',
            'moviePerformances',
            'directorPerformances',
            'chartLabels',
            'chartData',
            'moviesList',
            'directorsList'
        ));
    }
}
