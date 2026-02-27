<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    protected $fillable = [
        'booking_id',
        'total_amount',
        'status',
        'total_items',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}