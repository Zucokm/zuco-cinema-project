<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\FoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
{
    public function index()
    {
  
        $foodItems = FoodItem::with('foodType')->latest()->get();
        return view('admin.food_items.index', compact('foodItems'));
    }

    public function create()
    {
  
        $foodTypes = FoodType::where('isActive', true)->get();
        return view('admin.food_items.create', compact('foodTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_type_id' => 'required|exists:food_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'imagePath' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('imagePath');
        $data['isActive'] = $request->has('isActive');


        if ($request->hasFile('imagePath')) {
            $data['imagePath'] = $request->file('imagePath')->store('food_items', 'public');
        }

        FoodItem::create($data);

        return redirect()->route('admin.food-items.index')->with('success', 'Food Item created successfully!');
    }

    public function edit(FoodItem $foodItem)
    {
      
        $foodTypes = FoodType::all();
        return view('admin.food_items.edit', compact('foodItem', 'foodTypes'));
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'food_type_id' => 'required|exists:food_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'imagePath' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('imagePath');
        $data['isActive'] = $request->has('isActive');

 
        if ($request->hasFile('imagePath')) {
            if ($foodItem->imagePath) {
                Storage::disk('public')->delete($foodItem->imagePath);
            }
            $data['imagePath'] = $request->file('imagePath')->store('food_items', 'public');
        }

        $foodItem->update($data);

        return redirect()->route('admin.food-items.index')->with('success', 'Food Item updated successfully!');
    }

    public function destroy(FoodItem $foodItem)
    {
      
        if ($foodItem->imagePath) {
            Storage::disk('public')->delete($foodItem->imagePath);
        }
        
        $foodItem->delete();

        return redirect()->route('admin.food-items.index')->with('success', 'Food Item deleted successfully!');
    }
}