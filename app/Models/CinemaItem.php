<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaItem extends Model
{
    protected $fillable = [
        'cinema_id',
        'food_item_id',
        'isAvailable',
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }

    public function toggleAvailability(): void
    {
        $this->isAvailable = !$this->isAvailable;
        $this->save();
    }
}