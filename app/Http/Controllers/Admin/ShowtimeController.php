<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showtime;
use App\Models\Movie;
use App\Models\CinemaHall;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowtimeController extends Controller
{
    public function index(Request $request)
    {
        $query = Showtime::with(['movie', 'cinemaHall.cinema']);

        // 1. Filter by Date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // 2. Filter by Movie
        if ($request->filled('movie_id')) {
            $query->where('movie_id', $request->movie_id);
        }

        // 3. Filter by Cinema
        if ($request->filled('cinema_id')) {
            $query->whereHas('cinemaHall', function ($q) use ($request) {
                $q->where('cinema_id', $request->cinema_id);
            });
        }

        $showtimes = $query->orderBy('date', 'desc')
            ->orderBy('start_time', 'asc')
            ->paginate(20)
            ->withQueryString(); // Pagination နှိပ်ရင် Filter မပျောက်အောင်

        $movies = Movie::select('id', 'title')->orderBy('title')->get();
        $cinemas = \App\Models\Cinema::select('id', 'name')->orderBy('name')->get();

        return view('admin.showtimes.index', compact('showtimes', 'movies', 'cinemas'));
    }

    public function edit(\App\Models\Showtime $showtime)
    {
        $movies = Movie::select('id', 'title', 'duration')->latest()->get();
        $halls = CinemaHall::with('cinema')->get();

        return view('admin.showtimes.edit', compact('showtime', 'movies', 'halls'));
    }

    public function update(Request $request, \App\Models\Showtime $showtime)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_hall_id' => 'required|exists:cinema_halls,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        $movie = Movie::findOrFail($request->movie_id);


        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addMinutes($movie->duration);

        $showtime->update([
            'movie_id' => $request->movie_id,
            'cinema_hall_id' => $request->cinema_hall_id,
            'date' => $request->date,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ]);

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime updated successfully!');
    }

    public function destroy(\App\Models\Showtime $showtime)
    {
        $showtime->delete();

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime deleted successfully!');
    }

    public function create()
    {

        $movies = Movie::select('id', 'title', 'duration')->latest()->get();

        $halls = CinemaHall::with('cinema')->get();

        return view('admin.showtimes.create', compact('movies', 'halls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'cinema_hall_id' => 'required|exists:cinema_halls,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
        ]);


        $movie = Movie::findOrFail($request->movie_id);


        $startTime = Carbon::createFromFormat('H:i', $request->start_time);


        $endTime = $startTime->copy()->addMinutes($movie->duration);


        Showtime::create([
            'movie_id' => $request->movie_id,
            'cinema_hall_id' => $request->cinema_hall_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $endTime->format('H:i:s'),
        ]);

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime created successfully!');
    }
}
