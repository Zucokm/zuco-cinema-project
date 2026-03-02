<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'township', 'city', 'phone', 'photoPath'];

    public function halls()
    {
        return $this->hasMany(CinemaHall::class);
    }

    public function cinemaItems()
    {
        return $this->hasMany(CinemaItem::class);
    }
}
