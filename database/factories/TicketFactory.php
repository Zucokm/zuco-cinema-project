<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'seat_id' => \App\Models\Seat::inRandomOrder()->first()->id ?? \App\Models\Seat::factory(),
            'price' => fake()->randomFloat(2, 3000, 15000),
        ];
    }
}
