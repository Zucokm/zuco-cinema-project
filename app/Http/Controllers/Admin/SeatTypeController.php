<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeatType;
use Illuminate\Http\Request;

class SeatTypeController extends Controller
{

    public function index()
    {
        $seatTypes = \App\Models\SeatType::latest()->get();
        return view('admin.seat_types.index', compact('seatTypes'));
    }

    public function create()
    {
        return view('admin.seat_types.create');
    }

    public function edit(\App\Models\SeatType $seat_type)
    {
        return view('admin.seat_types.edit', compact('seat_type'));
    }

    public function update(Request $request, \App\Models\SeatType $seat_type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $seat_type->update($validated);

        return redirect()->route('admin.seat-types.index')->with('success', 'Seat Type updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', 
            'description' => 'nullable|string|max:1000',
        ]);

        SeatType::create($validated);

        return redirect()->route('admin.seat-types.index')->with('success', 'Seat Type created successfully!');
    }

    public function destroy(\App\Models\SeatType $seat_type)
    {
        $seat_type->delete();

        return redirect()->route('admin.seat-types.index')->with('success', 'Seat Type deleted successfully!');
    }
}
