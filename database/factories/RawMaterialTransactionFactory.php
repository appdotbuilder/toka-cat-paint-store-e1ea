<?php

namespace Database\Factories;

use App\Models\RawMaterial;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RawMaterialTransaction>
 */
class RawMaterialTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomFloat(2, 1, 100);
        $unitPrice = fake()->randomFloat(2, 10000, 100000);
        
        return [
            'raw_material_id' => RawMaterial::factory(),
            'supplier_id' => fake()->boolean(80) ? Supplier::factory() : null,
            'type' => fake()->randomElement(['in', 'out']),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_amount' => $quantity * $unitPrice,
            'notes' => fake()->optional()->sentence(),
            'transaction_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}