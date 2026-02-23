<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = [
        'food_type_id',
        'name',
        'description',
        'price',
        'imagePath',
        'isActive',
    ];

    public function foodType()
    {
        return $this->belongsTo(FoodType::class);
    }

    public function cinemaItems()
    {
        return $this->hasMany(CinemaItem::class);
    }
}