<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatType extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}