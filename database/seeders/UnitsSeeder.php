<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Liter', 'symbol' => 'L'],
            ['name' => 'Kilogram', 'symbol' => 'kg'],
            ['name' => 'Pieces', 'symbol' => 'pcs'],
            ['name' => 'Gallon', 'symbol' => 'gal'],
            ['name' => 'Meter', 'symbol' => 'm'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}