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
            [
                'code' => 'SVC005',
                'serviceName' => 'Asuransi Pengiriman',
                'description' => 'Menjamin keamanan barang selama proses pengiriman.',
                'price' => 75000,
                'icon' => 'ti ti-shield-check',
            ],
            [
                'code' => 'SVC006',
                'serviceName' => 'Pengemasan Premium',
                'description' => 'Menggunakan bahan kemasan berkualitas tinggi untuk keamanan ekstra.',
                'price' => 60000,
                'icon' => 'ti ti-package',
            ],
            [
                'code' => 'SVC007',
                'serviceName' => 'Penjagaan Penuh',
                'description' => 'Ekstra Proteksi.',
                'price' => 30000,
                'icon' => 'ti ti-map-pin',
            ],
            [
                'code' => 'SVC008',
                'serviceName' => 'Penjemputan Barang di Lokasi',
                'description' => 'Kurir akan menjemput barang langsung ke alamat Anda.',
                'price' => 80000,
                'icon' => 'ti ti-truck',
            ],
            [
                'code' => 'SVC009',
                'serviceName' => 'Layanan Prioritas',
                'description' => 'Pengiriman lebih cepat dan diprioritaskan.',
                'price' => 100000,
                'icon' => 'ti ti-clock-fast',
            ],
            [
                'code' => 'SVC010',
                'serviceName' => 'Bantuan Bongkar Muat',
                'description' => 'Tenaga bantuan untuk proses bongkar muat barang.',
                'price' => 90000,
                'icon' => 'ti ti-armchair',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}