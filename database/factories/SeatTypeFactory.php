<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatType>
 */
class SeatTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Standard', 'Premium', 'VIP', 'Couple']),
            'price' => fake()->randomElement([3000, 5000, 10000, 15000]),
            'description' => fake()->sentence(),
        ];
    }
}
