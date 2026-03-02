<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CinemaItem>
 */
class CinemaItemFactory extends Factory
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
            'food_item_id' => \App\Models\FoodItem::inRandomOrder()->first()->id ?? \App\Models\FoodItem::factory(),
            'isAvailable' => fake()->boolean(90),
        ];
    }
}
