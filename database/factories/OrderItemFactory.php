<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_order_id' => \App\Models\FoodOrder::inRandomOrder()->first()->id ?? \App\Models\FoodOrder::factory(),
            'food_item_id' => \App\Models\FoodItem::inRandomOrder()->first()->id ?? \App\Models\FoodItem::factory(),
            'quantity' => fake()->numberBetween(1, 4),
            'price' => fake()->randomFloat(2, 1000, 10000),
        ];
    }
}
