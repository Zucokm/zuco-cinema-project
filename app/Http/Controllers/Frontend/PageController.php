<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {

        $movies = \App\Models\Movie::latest()->take(5)->get();

        $cinemas = \App\Models\Cinema::latest()->take(3)->get();

        return view('frontend.home', compact('movies', 'cinemas'));
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
}