<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'count' => fake()->numberBetween(1, 10),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['new', 'completed']),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
