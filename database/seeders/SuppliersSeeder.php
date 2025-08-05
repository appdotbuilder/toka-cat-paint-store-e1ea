<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Avia Avian',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-12345678',
                'email' => 'budi@avian.co.id',
                'address' => 'Jakarta Pusat, DKI Jakarta'
            ],
            [
                'name' => 'PT Propan Raya',
                'contact_person' => 'Siti Nurhaliza',
                'phone' => '021-87654321',
                'email' => 'siti@propan.co.id',
                'address' => 'Tangerang, Banten'
            ],
            [
                'name' => 'CV Jotun Indonesia',
                'contact_person' => 'Ahmad Rahman',
                'phone' => '021-11223344',
                'email' => 'ahmad@jotun.co.id',
                'address' => 'Bekasi, Jawa Barat'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}