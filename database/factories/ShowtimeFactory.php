<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\CinemaHall;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        // ရှိပြီးသား Movie တစ်ခုကို အရင်ယူမယ်
        $movie = Movie::inRandomOrder()->first() ?? Movie::factory()->create();
        
        // မနက် ၁၀ နာရီနဲ့ ည ၈ နာရီကြား စတင်ချိန်ကို Random ယူမယ်
        $startDateTime = fake()->dateTimeBetween('10:00:00', '20:00:00');
        $startTime = Carbon::parse($startDateTime);
        
        // Movie Duration အစစ်အမှန်အတိုင်း End Time ကို တွက်မယ်
        $endTime = $startTime->copy()->addMinutes($movie->duration);

        return [
            'movie_id' => $movie->id,
            'cinema_hall_id' => CinemaHall::inRandomOrder()->first()->id ?? CinemaHall::factory(),
            'date' => fake()->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ];
    }
}