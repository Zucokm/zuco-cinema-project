<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('10:00:00', '20:00:00');
        $endTime = (clone $startTime)->modify('+2 hours');

        return [
            'movie_id' => \App\Models\Movie::inRandomOrder()->first()->id ?? \App\Models\Movie::factory(),
            'cinema_hall_id' => \App\Models\CinemaHall::inRandomOrder()->first()->id ?? \App\Models\CinemaHall::factory(),
            'date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ];
    }
}
