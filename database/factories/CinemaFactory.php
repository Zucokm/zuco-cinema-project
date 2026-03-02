<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cinema>
 */
class CinemaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Cinema',
            'address' => fake()->streetAddress(),
            'township' => fake()->citySuffix(),
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
            'photoPath' => fake()->imageUrl(800, 600, 'cinemas'),
        ];
    }
}
