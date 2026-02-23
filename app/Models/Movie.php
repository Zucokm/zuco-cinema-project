<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable = [
        'title',
        'description',
        'imagePath',
        'bgImagePath',
        'duration',
        'releaseDate',
        'director',
        'genre',
        'trailerLink',
        'rating',
        'language',
        'likeCount'
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
