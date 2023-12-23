<?php

namespace Database\Factories;

use App\Models\{ Post, User };
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'body' => fake()->text(500),
            'post_id' => Post::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}
