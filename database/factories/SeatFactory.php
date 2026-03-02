<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $row = fake()->randomElement(['A', 'B', 'C', 'D', 'E']);
        $number = fake()->numberBetween(1, 20);
        return [
            'cinema_hall_id' => \App\Models\CinemaHall::inRandomOrder()->first()->id ?? \App\Models\CinemaHall::factory(),
            'seat_type_id' => \App\Models\SeatType::inRandomOrder()->first()->id ?? \App\Models\SeatType::factory(),
            'row' => $row,
            'number' => $number,
            'seat_code' => $row . '-' . $number,
        ];
    }
}
