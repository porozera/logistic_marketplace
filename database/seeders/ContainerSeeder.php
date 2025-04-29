<?php

namespace Database\Seeders;

use App\Models\Container;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $containers = [
            [
                'code' => 'CNT001',
                'name' => "20' Standard",
                'weight' => 24000,
                'volume' => 33,
                'description' => 'Kontainer 20 kaki standar untuk kargo umum.'
            ],
            [
                'code' => 'CNT002',
                'name' => "40' Standard",
                'weight' => 30000,
                'volume' => 67,
                'description' => 'Kontainer 40 kaki standar untuk pengiriman skala besar.'
            ],
            [
                'code' => 'CNT003',
                'name' => "40' High Cube",
                'weight' => 30000,
                'volume' => 76,
                'description' => 'Kontainer 40 kaki high cube, lebih tinggi untuk volume ekstra.'
            ],
            [
                'code' => 'CNT004',
                'name' => "40' Refrigerated",
                'weight' => 29000,
                'volume' => 67,
                'description' => 'Kontainer berpendingin untuk produk makanan dan farmasi.'
            ],
            [
                'code' => 'CNT005',
                'name' => "20' Flatrack Collapsible",
                'weight' => 25000,
                'volume' => 32,
                'description' => 'Kontainer flat rack untuk kargo berat dan berukuran besar.'
            ],
            [
                'code' => 'CNT006',
                'name' => "20' Bulk",
                'weight' => 24000,
                'volume' => 33,
                'description' => 'Kontainer bulk untuk material curah seperti biji-bijian.'
            ],
            [
                'code' => 'CNT007',
                'name' => "40' Open Top",
                'weight' => 30000,
                'volume' => 65,
                'description' => 'Kontainer open top untuk muatan tinggi atau mesin besar.'
            ],
            [
                'code' => 'CNT008',
                'name' => "20' Open Top",
                'weight' => 24000,
                'volume' => 32,
                'description' => 'Kontainer open top 20 kaki untuk akses atas.'
            ],
            [
                'code' => 'CNT009',
                'name' => "20' Refrigerated",
                'weight' => 22000,
                'volume' => 28,
                'description' => 'Kontainer pendingin 20 kaki untuk makanan segar.'
            ],
            [
                'code' => 'CNT010',
                'name' => "45' High Cube",
                'weight' => 32000,
                'volume' => 86,
                'description' => 'Kontainer 45 kaki high cube untuk volume ekstra besar.'
            ],
        ];

        foreach ($containers as $container) {
            Container::create($container);
        }
    }
}
