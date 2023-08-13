<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            "Technology", "Science", "Literature", "Art", "History", "Sports", "Music", "Food and Cooking", "Travel", "Health and Wellness", "Fashion", "Nature and Environment", "Business and Finance", "Movies and Film", "Gaming", "Education", "Philosophy", "Religion and Spirituality", "Politics", "DIY and Crafts"
        ];

        return [
            "name" => fake()->randomElement($categories),
            "user_id" => User::all()->random()
        ];
    }
}
