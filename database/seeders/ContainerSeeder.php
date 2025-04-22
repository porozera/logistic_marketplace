<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('containers')->insert([
            [
                'code' => '20GP',
                'name' => '20 Feet General Purpose',
                'weight' => 2250, // berat kosong dalam kg
                'volume' => 33,    // volume dalam m³ (approx)
                'description' => 'Kontainer 20 kaki standar untuk muatan general cargo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '40GP',
                'name' => '40 Feet General Purpose',
                'weight' => 3800,
                'volume' => 67,
                'description' => 'Kontainer 40 kaki standar untuk muatan general cargo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '40HC',
                'name' => '40 Feet High Cube',
                'weight' => 3900,
                'volume' => 76,
                'description' => 'Kontainer 40 kaki dengan tinggi lebih (High Cube)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '20RF',
                'name' => '20 Feet Reefer',
                'weight' => 3000,
                'volume' => 28,
                'description' => 'Kontainer pendingin 20 kaki (Reefer)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => '40RF',
                'name' => '40 Feet Reefer',
                'weight' => 4500,
                'volume' => 67,
                'description' => 'Kontainer pendingin 40 kaki (Reefer)',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
