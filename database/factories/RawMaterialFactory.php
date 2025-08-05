<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RawMaterial>
 */
class RawMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materials = [
            'Base Paint White',
            'Base Paint Black',
            'Thinner',
            'Paint Brushes',
            'Colorant Red',
            'Colorant Blue',
            'Colorant Yellow',
            'Primer',
            'Hardener',
            'Solvent',
        ];

        return [
            'name' => fake()->randomElement($materials),
            'unit_id' => Unit::factory(),
            'current_stock' => fake()->randomFloat(2, 10, 1000),
            'minimum_stock' => fake()->randomFloat(2, 5, 50),
        ];
    }
}