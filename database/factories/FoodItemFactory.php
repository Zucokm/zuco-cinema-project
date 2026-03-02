<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodItem>
 */
class FoodItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_type_id' => \App\Models\FoodType::inRandomOrder()->first()->id ?? \App\Models\FoodType::factory(),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1000, 15000),
            'imagePath' => fake()->imageUrl(400, 400, 'food'),
            'isActive' => true,
        ];
    }
}
