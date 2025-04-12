<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data layanan
        $categories = [
            [
                'code' => 'GC01',
                'name' => 'Pakaian',
                'type' => 'General Cargo',
                'description' => 'Pakaian',
            ],
            [
                'code' => 'GC02',
                'name' => 'Alat Olahraga',
                'type' => 'General Cargo',
                'description' => 'Alat Olahraga',
            ],
            [
                'code' => 'GC03',
                'name' => 'Tas',
                'type' => 'General Cargo',
                'description' => 'Tas',
            ],
            [
                'code' => 'GC04',
                'name' => 'Peralatan Rumah Tangga',
                'type' => 'General Cargo',
                'description' => 'Peralatan Rumah Tangga',
            ],
            [
                'code' => 'GC05',
                'name' => 'Peralatan Kantor',
                'type' => 'General Cargo',
                'description' => 'Peralatan Kantor',
            ],
            [
                'code' => 'GC06',
                'name' => 'Sepatu',
                'type' => 'General Cargo',
                'description' => 'Sepatu',
            ],
            [
                'code' => 'GC07',
                'name' => 'Elektornik',
                'type' => 'General Cargo',
                'description' => 'Elektornik',
            ],
            [
                'code' => 'SC01',
                'name' => 'Hewan',
                'type' => 'Special Cargo',
                'description' => 'Hewan',
            ],
            [
                'code' => 'SC02',
                'name' => 'Makanan Segar',
                'type' => 'Special Cargo',
                'description' => 'Makanan Segar',
            ],
            [
                'code' => 'SC03',
                'name' => 'Tanaman Hias',
                'type' => 'Special Cargo',
                'description' => 'Tanaman Hias',
            ],
            [
                'code' => 'SC04',
                'name' => 'Emas',
                'type' => 'Special Cargo',
                'description' => 'Emas',
            ],
            [
                'code' => 'SC05',
                'name' => 'Berlian',
                'type' => 'Special Cargo',
                'description' => 'Berlian',
            ],
            [
                'code' => 'DC01',
                'name' => 'Senjata',
                'type' => 'Dangerous Cargo',
                'description' => 'Senjata',
            ],
            [
                'code' => 'DC02',
                'name' => 'Cairan Kimia',
                'type' => 'Dangerous Cargo',
                'description' => 'Cairan Kimia',
            ],
            [
                'code' => 'DC03',
                'name' => 'Peledeak',
                'type' => 'Dangerous Cargo',
                'description' => 'Peledeak',
            ],
            [
                'code' => 'DC04',
                'name' => 'Petasan',
                'type' => 'Dangerous Cargo',
                'description' => 'Petasan',
            ],
            [
                'code' => 'DC05',
                'name' => 'Peluru',
                'type' => 'Dangerous Cargo',
                'description' => 'Peluru',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
