<?php

namespace Database\Factories;

use App\Models\FinishedProduct;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItem>
 */
class SaleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomFloat(2, 0.25, 10);
        $unitPrice = fake()->randomFloat(2, 25000, 200000);
        
        return [
            'sale_id' => Sale::factory(),
            'finished_product_id' => FinishedProduct::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $quantity * $unitPrice,
        ];
    }
}