<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Supplier;
use App\Models\RawMaterial;
use App\Models\FinishedProduct;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TokaCatTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('welcome')
        );
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => 
            $page->component('dashboard')
                ->has('stats')
                ->has('recentSales')
        );
    }

    public function test_can_create_supplier(): void
    {
        $supplier = Supplier::factory()->create([
            'name' => 'PT Test Supplier',
            'contact_person' => 'John Doe',
            'phone' => '021-12345678',
            'email' => 'john@testsupplier.com',
        ]);

        $this->assertDatabaseHas('suppliers', [
            'name' => 'PT Test Supplier',
            'contact_person' => 'John Doe',
        ]);
    }

    public function test_can_create_category_and_unit(): void
    {
        $category = Category::factory()->create([
            'name' => 'Test Paint Category',
            'description' => 'Test category for paint products',
        ]);

        $unit = Unit::factory()->create([
            'name' => 'Liter',
            'symbol' => 'L',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Paint Category',
        ]);

        $this->assertDatabaseHas('units', [
            'symbol' => 'L',
        ]);
    }

    public function test_can_create_raw_material(): void
    {
        $unit = Unit::factory()->create(['name' => 'Liter', 'symbol' => 'L']);
        
        $rawMaterial = RawMaterial::factory()->create([
            'name' => 'Base Paint White',
            'unit_id' => $unit->id,
            'current_stock' => 100.00,
            'minimum_stock' => 20.00,
        ]);

        $this->assertDatabaseHas('raw_materials', [
            'name' => 'Base Paint White',
            'current_stock' => 100.00,
        ]);
    }

    public function test_can_create_finished_product(): void
    {
        $category = Category::factory()->create(['name' => 'Wall Paint']);
        
        $product = FinishedProduct::factory()->create([
            'name' => 'Premium Wall Paint',
            'category_id' => $category->id,
            'color' => 'White',
            'size' => '1L',
            'selling_price' => 85000.00,
            'current_stock' => 50.00,
        ]);

        $this->assertDatabaseHas('finished_products', [
            'name' => 'Premium Wall Paint',
            'color' => 'White',
            'selling_price' => 85000.00,
        ]);
    }

    public function test_can_create_customer(): void
    {
        $customer = Customer::factory()->create([
            'name' => 'Test Customer',
            'phone' => '08123456789',
            'type' => 'retail',
        ]);

        $this->assertDatabaseHas('customers', [
            'name' => 'Test Customer',
            'type' => 'retail',
        ]);
    }

    public function test_raw_material_low_stock_scope(): void
    {
        $unit = Unit::factory()->create();
        
        // Create raw material with low stock
        $lowStockMaterial = RawMaterial::factory()->create([
            'current_stock' => 5.00,
            'minimum_stock' => 10.00,
            'unit_id' => $unit->id,
        ]);
        
        // Create raw material with normal stock
        $normalStockMaterial = RawMaterial::factory()->create([
            'current_stock' => 50.00,
            'minimum_stock' => 10.00,
            'unit_id' => $unit->id,
        ]);

        $lowStockMaterials = RawMaterial::lowStock()->get();

        $this->assertCount(1, $lowStockMaterials);
        $this->assertEquals($lowStockMaterial->id, $lowStockMaterials->first()->id);
    }

    public function test_finished_product_low_stock_scope(): void
    {
        $category = Category::factory()->create();
        
        // Create product with low stock
        $lowStockProduct = FinishedProduct::factory()->create([
            'current_stock' => 3.00,
            'minimum_stock' => 5.00,
            'category_id' => $category->id,
        ]);
        
        // Create product with normal stock
        $normalStockProduct = FinishedProduct::factory()->create([
            'current_stock' => 25.00,
            'minimum_stock' => 5.00,
            'category_id' => $category->id,
        ]);

        $lowStockProducts = FinishedProduct::lowStock()->get();

        $this->assertCount(1, $lowStockProducts);
        $this->assertEquals($lowStockProduct->id, $lowStockProducts->first()->id);
    }
}