<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CinemaHall extends Model
{
    protected $fillable = ['cinema_id', 'name', 'totalSeats', 'floor', 'photoPath'];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
