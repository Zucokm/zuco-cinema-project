<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodOrder>
 */
class FoodOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => \App\Models\Booking::inRandomOrder()->first()->id ?? \App\Models\Booking::factory(),
            'total_amount' => fake()->randomFloat(2, 2000, 30000),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'total_items' => fake()->numberBetween(1, 5),
        ];
    }
}
