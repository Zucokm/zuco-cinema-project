<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use App\Models\FoodType;
use App\Models\CinemaItem;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class CinemaItemController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::all();
        return view('admin.cinema_items.index', compact('cinemas'));
    }

    public function manage(Cinema $cinema)
    {
        $foodTypes = FoodType::with(['foodItems' => function($query) {
            $query->where('isActive', true);
        }])->where('isActive', true)->get();

    
        $availableItemIds = CinemaItem::where('cinema_id', $cinema->id)
            ->where('isAvailable', true)
            ->pluck('food_item_id')
            ->toArray();

        return view('admin.cinema_items.manage', compact('cinema', 'foodTypes', 'availableItemIds'));
    }

  
    public function store(Request $request, Cinema $cinema)
    {
  
        $selectedFoodItemIds = $request->input('food_items', []);


        $allFoodItems = FoodItem::where('isActive', true)->get();

        foreach ($allFoodItems as $foodItem) {
  
            $isAvailable = in_array($foodItem->id, $selectedFoodItemIds);

          
            CinemaItem::updateOrCreate(
                [
                    'cinema_id' => $cinema->id,
                    'food_item_id' => $foodItem->id,
                ],
                [
                    'isAvailable' => $isAvailable,
                ]
            );
        }

        return redirect()->route('admin.cinema-items.index')
            ->with('success', 'Food menu updated successfully for ' . $cinema->name . '!');
    }
}