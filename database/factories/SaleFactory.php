<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50000, 1000000);
        $discountAmount = fake()->randomFloat(2, 0, $subtotal * 0.1);
        $taxAmount = fake()->randomFloat(2, 0, $subtotal * 0.1);
        $totalAmount = $subtotal - $discountAmount + $taxAmount;

        return [
            'invoice_number' => 'INV-' . fake()->unique()->numerify('########'),
            'customer_id' => fake()->boolean(70) ? Customer::factory() : null,
            'cashier_id' => User::factory(['role' => 'cashier']),
            'sale_type' => fake()->randomElement(['retail', 'wholesale']),
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'payment_method' => fake()->randomElement(['cash', 'transfer']),
            'sale_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}