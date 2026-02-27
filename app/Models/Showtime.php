<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $fillable = [
        'movie_id',
        'cinema_hall_id',
        'date',
        'start_time',
        'end_time'
    ];

   
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function cinemaHall()
    {
        return $this->belongsTo(CinemaHall::class);
    }
}
