<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $title = fake()->unique()->sentence(8),
            'slug' => Str::slug($title),
            'image' => fake()->filePath(),
            'excerpt' => fake()->text(255),
            'description' => fake()->text(500),
            'user_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}
