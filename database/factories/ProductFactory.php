<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=>User::all()->random(),
            'category_id'=>Category::all()->random(),
            'name'=>fake()->name(),
            'price'=>fake()->randomElement([100,250,452,89]),
            'unit'=>fake()->randomElement([50,78,95,100]),
            'thumbnail'=>fake()->imageUrl()
        ];
    }
}
