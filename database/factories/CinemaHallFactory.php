<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CinemaHall>
 */
class CinemaHallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cinema_id' => \App\Models\Cinema::inRandomOrder()->first()->id ?? \App\Models\Cinema::factory(),
            'name' => 'Hall ' . fake()->numberBetween(1, 10),
            'totalSeats' => fake()->numberBetween(50, 200),
            'floor' => fake()->numberBetween(1, 5) . 'F',
            'photoPath' => fake()->imageUrl(800, 600, 'halls'),
        ];
    }
}
