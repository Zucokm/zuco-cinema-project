<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodTypeController extends Controller
{
    public function index()
    {

        $foodTypes = FoodType::latest()->get();
        return view('admin.food_types.index', compact('foodTypes'));
    }

    public function create()
    {
        return view('admin.food_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagePath' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('imagePath');
        
       
        $data['isActive'] = $request->has('isActive');


        if ($request->hasFile('imagePath')) {
            $data['imagePath'] = $request->file('imagePath')->store('food_types', 'public');
        }

        FoodType::create($data);

        return redirect()->route('admin.food-types.index')->with('success', 'Food Type created successfully!');
    }

    public function edit(FoodType $foodType)
    {
        return view('admin.food_types.edit', compact('foodType'));
    }

    public function update(Request $request, FoodType $foodType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'imagePath' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('imagePath');
        $data['isActive'] = $request->has('isActive');

     
        if ($request->hasFile('imagePath')) {
       
            if ($foodType->imagePath) {
                Storage::disk('public')->delete($foodType->imagePath);
            }

            $data['imagePath'] = $request->file('imagePath')->store('food_types', 'public');
        }

        $foodType->update($data);

        return redirect()->route('admin.food-types.index')->with('success', 'Food Type updated successfully!');
    }

    public function destroy(FoodType $foodType)
    {
      
        if ($foodType->imagePath) {
            Storage::disk('public')->delete($foodType->imagePath);
        }
        
        $foodType->delete();

        return redirect()->route('admin.food-types.index')->with('success', 'Food Type deleted successfully!');
    }
}