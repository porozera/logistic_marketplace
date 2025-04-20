<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service; // Pastikan Anda mengimpor model Service

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data layanan
        $services = [
            [
                'code' => 'SVC001',
                'serviceName' => 'Barang Pecah Belah',
                'description' => 'Untuk barang pecah belah.',
                'price' => 150000,
                'icon' => 'ti ti-glass', // Contoh ikon Font Awesome
            ],
            [
                'code' => 'SVC002',
                'serviceName' => 'Gudang',
                'description' => 'Sewa gudang sementara.',
                'price' => 1000000,
                'icon' => 'ti ti-building-warehouse',
            ],
            [
                'code' => 'SVC003',
                'serviceName' => 'Inspeksi Sebelum Pengiriman',
                'description' => 'Melakukan pengecekan barang sebelum pengiriman.',
                'price' => 250000,
                'icon' => 'ti ti-user-check',
            ],
            [
                'code' => 'SVC004',
                'serviceName' => 'Mengurangi Penggunaan Karbon',
                'description' => 'Mengurangi penggunaan karbon.',
                'price' => 50000,
                'icon' => 'ti ti-leaf',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}