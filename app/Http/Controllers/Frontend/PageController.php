<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Carbon\Carbon;
use App\Models\Cinema;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home(Request $request)
    {

        if ($request->filled('search')) {
            $movies = \App\Models\Movie::where('title', 'like', '%' . $request->search . '%')
                ->orWhere('genre', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $movies = \App\Models\Movie::latest()->take(5)->get();
        }

        $cinemas = \App\Models\Cinema::latest()->take(3)->get();

        return view('frontend.home', compact('movies', 'cinemas'));
    }

    public function movies(Request $request)
    {
        $tab = $request->get('tab', 'now_showing');
        $query = Movie::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('genre', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($tab === 'coming_soon') {
            $query->whereDoesntHave('showtimes', function($q) {
                $q->where('date', '>=', Carbon::today());
            });
        } else {
            $query->whereHas('showtimes', function($q) {
                $q->where('date', '>=', Carbon::today());
            });
        }

        $movies = $query->latest()->paginate(12)->withQueryString();

        $genres = Movie::select('genre')->distinct()->whereNotNull('genre')->orderBy('genre')->pluck('genre');

        return view('frontend.movies', compact('movies', 'tab', 'genres'));
    }

    public function cinemas()
    {
        $cinemas = Cinema::latest()->get();
        return view('frontend.cinemas', compact('cinemas'));
    }

    public function movieDetails(Movie $movie)
    {

        $showtimesByDate = $movie->showtimes()
            ->with('cinemaHall.cinema') 
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy('date');

        return view('frontend.movie_details', compact('movie', 'showtimesByDate'));
    }

    public function cinemaDetails(Cinema $cinema)
    {
        // ဒီ Cinema မှာပြမယ့် ရုပ်ရှင်တွေကိုပဲ ရှာမယ် (Showtime ရှိမှ)
        $movies = Movie::whereHas('showtimes.cinemaHall', function ($query) use ($cinema) {
            $query->where('cinema_id', $cinema->id)
                  ->where('date', '>=', Carbon::today());
        })
        ->with(['showtimes' => function ($query) use ($cinema) {
            // ရုပ်ရှင်တစ်ခုချင်းစီအတွက် ဒီ Cinema က ပွဲချိန်တွေကိုပဲ Eager Load လုပ်မယ်
            $query->whereHas('cinemaHall', function ($q) use ($cinema) {
                $q->where('cinema_id', $cinema->id);
            })
            ->where('date', '>=', Carbon::today())
            ->with(['cinemaHall', 'bookings' => function($q) {
                // Confirmed သို့မဟုတ် Pending ဖြစ်နေသော Booking များကိုသာ ရေတွက်မည်
                $q->whereIn('status', ['confirmed', 'pending'])->withCount('tickets');
            }])
            ->orderBy('date')
            ->orderBy('start_time');
        }])
        ->get();

        return view('frontend.cinema_details', compact('cinema', 'movies'));
    }
}