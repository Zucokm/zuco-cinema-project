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
}
