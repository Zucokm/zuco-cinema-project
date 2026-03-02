<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'imagePath' => fake()->imageUrl(400, 600, 'movies'),
            'bgImagePath' => fake()->imageUrl(1920, 1080, 'backgrounds'),
            'duration' => fake()->numberBetween(90, 180),
            'releaseDate' => fake()->date(),
            'director' => fake()->name(),
            'genre' => fake()->randomElement(['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi']),
            'trailerLink' => 'https://youtube.com/watch?v=sample',
            'rating' => fake()->randomFloat(1, 1, 10),
            'language' => fake()->randomElement(['English', 'Myanmar', 'Korean']),
            'likeCount' => fake()->numberBetween(0, 5000),
        ];
    }
}
