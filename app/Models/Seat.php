<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'cinema_hall_id',
        'seat_type_id',
        'row',
        'number',
        'seat_code'
    ];

    public function cinemaHall()
    {
        return $this->belongsTo(CinemaHall::class);
    }

    public function seatType()
    {
        return $this->belongsTo(SeatType::class);
    }
}
