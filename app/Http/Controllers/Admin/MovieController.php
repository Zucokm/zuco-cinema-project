<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Model;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {

        $movies = Movie::latest()->get();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:10',
            'duration' => 'required|integer',
            'releaseDate' => 'required|date',
            'trailerLink' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $validated['imagePath'] = $request->file('image')->store('movies/posters', 'public');
        }

        if ($request->hasFile('bg_image')) {
            $validated['bgImagePath'] = $request->file('bg_image')->store('movies/backgrounds', 'public');
        }


        Movie::create($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully!');
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:10',
            'duration' => 'required|integer',
            'releaseDate' => 'required|date',
            'trailerLink' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            if ($movie->imagePath) {
                Storage::disk('public')->delete($movie->imagePath);
            }
            $validated['imagePath'] = $request->file('image')->store('movies/posters', 'public');
        }

        if ($request->hasFile('bg_image')) {
            if ($movie->bgImagePath) {
                Storage::disk('public')->delete($movie->bgImagePath);
            }
            $validated['bgImagePath'] = $request->file('bg_image')->store('movies/backgrounds', 'public');
        }

        $movie->update($validated);
        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {

        if ($movie->imagePath) {
            Storage::disk('public')->delete($movie->imagePath);
        }


        if ($movie->bgImagePath) {
            Storage::disk('public')->delete($movie->bgImagePath);
        }

        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie and associated images deleted successfully!');
    }
}
