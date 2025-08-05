<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\FinishedProduct;
use App\Models\RawMaterial;
use App\Models\RawMaterialTransaction;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some raw materials
        $literUnit = Unit::where('symbol', 'L')->first();
        $kgUnit = Unit::where('symbol', 'kg')->first();
        $pcsUnit = Unit::where('symbol', 'pcs')->first();

        $rawMaterials = [
            [
                'name' => 'Base Paint White',
                'unit_id' => $literUnit->id,
                'current_stock' => 500.00,
                'minimum_stock' => 50.00,
            ],
            [
                'name' => 'Thinner',
                'unit_id' => $literUnit->id,
                'current_stock' => 200.00,
                'minimum_stock' => 30.00,
            ],
            [
                'name' => 'Paint Brushes',
                'unit_id' => $pcsUnit->id,
                'current_stock' => 25.00,
                'minimum_stock' => 10.00,
            ],
            [
                'name' => 'Colorant Red',
                'unit_id' => $kgUnit->id,
                'current_stock' => 15.00,
                'minimum_stock' => 5.00,
            ],
            [
                'name' => 'Colorant Blue',
                'unit_id' => $kgUnit->id,
                'current_stock' => 8.00,
                'minimum_stock' => 5.00,
            ],
        ];

        foreach ($rawMaterials as $material) {
            RawMaterial::create($material);
        }

        // Create some finished products
        $wallPaintCategory = Category::where('name', 'Wall Paint')->first();
        $woodPaintCategory = Category::where('name', 'Wood Paint')->first();
        $metalPaintCategory = Category::where('name', 'Metal Paint')->first();

        $products = [
            [
                'name' => 'Premium Wall Paint',
                'category_id' => $wallPaintCategory->id,
                'color' => 'White',
                'size' => '1L',
                'selling_price' => 85000.00,
                'current_stock' => 50.00,
                'minimum_stock' => 10.00,
            ],
            [
                'name' => 'Premium Wall Paint',
                'category_id' => $wallPaintCategory->id,
                'color' => 'White',
                'size' => '5L',
                'selling_price' => 400000.00,
                'current_stock' => 25.00,
                'minimum_stock' => 5.00,
            ],
            [
                'name' => 'Premium Wall Paint',
                'category_id' => $wallPaintCategory->id,
                'color' => 'Red',
                'size' => '1L',
                'selling_price' => 95000.00,
                'current_stock' => 30.00,
                'minimum_stock' => 8.00,
            ],
            [
                'name' => 'Wood Stain',
                'category_id' => $woodPaintCategory->id,
                'color' => 'Brown',
                'size' => '1L',
                'selling_price' => 120000.00,
                'current_stock' => 15.00,
                'minimum_stock' => 5.00,
            ],
            [
                'name' => 'Anti-Rust Paint',
                'category_id' => $metalPaintCategory->id,
                'color' => 'Black',
                'size' => '1L',
                'selling_price' => 150000.00,
                'current_stock' => 20.00,
                'minimum_stock' => 5.00,
            ],
        ];

        foreach ($products as $product) {
            FinishedProduct::create($product);
        }

        // Create some customers
        $customers = [
            [
                'name' => 'Budi Wijaya',
                'phone' => '08123456789',
                'email' => 'budi@example.com',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'type' => 'retail',
            ],
            [
                'name' => 'CV Renovasi Jaya',
                'phone' => '02187654321',
                'email' => 'admin@renovasijaya.com',
                'address' => 'Jl. Industri No. 45, Bekasi',
                'type' => 'wholesale',
            ],
            [
                'name' => 'Siti Aminah',
                'phone' => '08567891234',
                'email' => null,
                'address' => 'Jl. Sudirman No. 67, Bogor',
                'type' => 'retail',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Create some sample sales
        $cashier = User::where('role', 'cashier')->first();
        $customer1 = Customer::first();
        $product1 = FinishedProduct::first();
        $product2 = FinishedProduct::skip(1)->first();

        $sale = Sale::create([
            'invoice_number' => 'INV-' . date('Ymd') . '-001',
            'customer_id' => $customer1->id,
            'cashier_id' => $cashier->id,
            'sale_type' => 'retail',
            'subtotal' => 180000.00,
            'discount_amount' => 0.00,
            'tax_amount' => 0.00,
            'total_amount' => 180000.00,
            'payment_method' => 'cash',
            'sale_date' => now(),
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'finished_product_id' => $product1->id,
            'quantity' => 2.00,
            'unit_price' => 85000.00,
            'total_price' => 170000.00,
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'finished_product_id' => $product2->id,
            'quantity' => 0.25,
            'unit_price' => 400000.00,
            'total_price' => 10000.00,
        ]);

        // Add some raw material transactions
        $supplier = Supplier::first();
        $rawMaterial = RawMaterial::first();

        RawMaterialTransaction::create([
            'raw_material_id' => $rawMaterial->id,
            'supplier_id' => $supplier->id,
            'type' => 'in',
            'quantity' => 100.00,
            'unit_price' => 25000.00,
            'total_amount' => 2500000.00,
            'notes' => 'Initial stock purchase',
            'transaction_date' => now()->subDays(7),
        ]);
    }
}