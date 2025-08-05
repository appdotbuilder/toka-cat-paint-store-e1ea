<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@tokacat.com',
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create cashier user
        User::factory()->create([
            'name' => 'Cashier User',
            'email' => 'cashier@tokacat.com',
            'role' => 'cashier',
            'is_active' => true,
        ]);

        // Create warehouse user
        User::factory()->create([
            'name' => 'Warehouse User',
            'email' => 'warehouse@tokacat.com',
            'role' => 'warehouse',
            'is_active' => true,
        ]);

        $this->call([
            UnitsSeeder::class,
            CategoriesSeeder::class,
            SuppliersSeeder::class,
            SampleDataSeeder::class,
        ]);
    }
}
