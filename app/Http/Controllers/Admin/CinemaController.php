<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cinemas = \App\Models\Cinema::latest()->get();
        return view('admin.cinemas.index', compact('cinemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'township' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photoPath'] = $request->file('photo')->store('cinemas', 'public');
        }

        Cinema::create($validated);

        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cinema $cinema)
    {
        return view('admin.cinemas.edit', compact('cinema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cinema $cinema)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'township' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            if ($cinema->photoPath) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($cinema->photoPath);
            }
            $validated['photoPath'] = $request->file('photo')->store('cinemas', 'public');
        }

        $cinema->update($validated);

        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema)
    {
        if ($cinema->photoPath) {
            Storage::disk('public')->delete($cinema->photoPath);
        }

        $cinema->delete();

        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema deleted successfully!');
    }
}
