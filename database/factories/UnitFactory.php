<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = [
            'Liter' => 'L',
            'Kilogram' => 'kg',
            'Pieces' => 'pcs',
            'Gallon' => 'gal',
            'Meter' => 'm',
        ];

        $name = fake()->randomElement(array_keys($units));
        
        return [
            'name' => $name,
            'symbol' => $units[$name],
        ];
    }
}