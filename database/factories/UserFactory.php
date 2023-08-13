<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $emails = ["liakatbiswas@gmail.com","nafi@gmail.com","biswas@gmail.com","nishe@gmail.com","demo@gmail.com"];
        return [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'email' => fake()->unique()->randomElement($emails),
            'phone' => fake()->phoneNumber(),
            'password' => 12345
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
