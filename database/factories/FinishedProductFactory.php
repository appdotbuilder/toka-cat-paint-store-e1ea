<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinishedProduct>
 */
class FinishedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = ['White', 'Black', 'Red', 'Blue', 'Green', 'Yellow', 'Brown', 'Gray'];
        $sizes = ['0.5L', '1L', '2.5L', '5L', '10L', '20L'];
        $products = [
            'Premium Wall Paint',
            'Economy Wall Paint',
            'Wood Stain',
            'Anti-Rust Paint',
            'Primer Paint',
            'Waterproof Paint',
        ];

        return [
            'name' => fake()->randomElement($products),
            'category_id' => Category::factory(),
            'color' => fake()->randomElement($colors),
            'size' => fake()->randomElement($sizes),
            'selling_price' => fake()->randomFloat(2, 50000, 500000),
            'current_stock' => fake()->randomFloat(2, 5, 100),
            'minimum_stock' => fake()->randomFloat(2, 1, 20),
        ];
    }
}