<?php

namespace Database\Factories;

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
            'Wall Paint' => 'Paint for interior and exterior walls',
            'Wood Paint' => 'Specialized paint for wooden surfaces',
            'Metal Paint' => 'Anti-rust and protective paint for metal surfaces',
            'Primer' => 'Base coat paint for better paint adhesion',
            'Specialty Paint' => 'Special purpose paints like waterproof, fire-resistant, etc.',
        ];

        $name = fake()->randomElement(array_keys($categories));
        
        return [
            'name' => $name,
            'description' => $categories[$name],
        ];
    }
}