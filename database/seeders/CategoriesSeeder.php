<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Wall Paint', 'description' => 'Paint for interior and exterior walls'],
            ['name' => 'Wood Paint', 'description' => 'Specialized paint for wooden surfaces'],
            ['name' => 'Metal Paint', 'description' => 'Anti-rust and protective paint for metal surfaces'],
            ['name' => 'Primer', 'description' => 'Base coat paint for better paint adhesion'],
            ['name' => 'Specialty Paint', 'description' => 'Special purpose paints like waterproof, fire-resistant, etc.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}