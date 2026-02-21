<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\CinemaHall;
use Illuminate\Http\Request;

class CinemaHallController extends Controller
{

    public function index()
    {
        $cinemas = \App\Models\Cinema::with(['halls' => function ($query) {
            $query->latest();
        }])->latest()->get();

        return view('admin.cinema_halls.index', compact('cinemas'));
    }

    public function create()
    {
        $cinemas = Cinema::all();
        return view('admin.cinema_halls.create', compact('cinemas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'name' => 'required|string|max:255',
            'totalSeats' => 'required|integer|min:1',
            'floor' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photoPath'] = $request->file('photo')->store('cinema_halls', 'public');
        }

        CinemaHall::create($validated);

        return redirect()->route('admin.cinema-halls.index')->with('success', 'Cinema Hall added successfully!');
    }


    public function edit(\App\Models\CinemaHall $cinema_hall)
    {
        $cinemas = \App\Models\Cinema::all();
        return view('admin.cinema_halls.edit', compact('cinema_hall', 'cinemas'));
    }

    public function update(Request $request, \App\Models\CinemaHall $cinema_hall)
    {
        $validated = $request->validate([
            'cinema_id' => 'required|exists:cinemas,id',
            'name' => 'required|string|max:255',
            'totalSeats' => 'required|integer|min:1',
            'floor' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($cinema_hall->photoPath) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($cinema_hall->photoPath);
            }
            $validated['photoPath'] = $request->file('photo')->store('cinema_halls', 'public');
        }

        $cinema_hall->update($validated);

        return redirect()->route('admin.cinema-halls.index')->with('success', 'Cinema Hall updated successfully!');
    }

    public function destroy(\App\Models\CinemaHall $cinema_hall) // Route parameter name
    {

        if ($cinema_hall->photoPath) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($cinema_hall->photoPath);
        }

        $cinema_hall->delete();

        return redirect()->route('admin.cinema-halls.index')->with('success', 'Cinema Hall deleted successfully!');
    }
}
