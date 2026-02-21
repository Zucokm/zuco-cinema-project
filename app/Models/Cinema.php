<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = ['name', 'address', 'township', 'city', 'phone', 'photoPath'];

    public function halls()
    {
        return $this->hasMany(CinemaHall::class);
    }
}
