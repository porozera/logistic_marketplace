<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'noOffer' => 'OFF-' . Str::random(6),
                'lspName' => 'PT Logistik Nusantara',
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'shipmentMode' => 'D2D',
                'shipmentType' => 'FCL',
                'loadingDate' => now()->addDays(3),
                'shippingDate' => now()->addDays(5),
                'estimationDate' => now()->addDays(10),
                'maxWeight' => 20000,
                'maxVolume' => 30,
                'remainingWeight' => 20000,
                'remainingVolume' => 30,
                'commodities' => 'Elektronik',
                'address' => 'Jl. Raya Jakarta No.123',
                'status' => 'Loading Item',
                'price' => 5000000,
                'totalAmount' => 5000000,
                'remainingAmount' => 5000000,
                'paidAmount' => 0,
                'paymentStatus' => 'Belum Lunas',
                'lsp_id' => 2,
                'truck_first_id' => null,
                'truck_second_id' => null,
            ],
            [
                'noOffer' => 'OFF-' . Str::random(6),
                'lspName' => 'PT Angkasa Raya',
                'origin' => 'Bandung',
                'destination' => 'Medan',
                'shipmentMode' => 'P2D',
                'shipmentType' => 'LCL',
                'loadingDate' => now()->addDays(2),
                'shippingDate' => now()->addDays(4),
                'estimationDate' => now()->addDays(9),
                'maxWeight' => 10000,
                'maxVolume' => 15,
                'remainingWeight' => 10000,
                'remainingVolume' => 15,
                'commodities' => 'Pakaian',
                'address' => 'Jl. Cihampelas No.45',
                'status' => 'On The Way',
                'price' => 3000000,
                'totalAmount' => 3000000,
                'remainingAmount' => 1000000,
                'paidAmount' => 2000000,
                'paymentStatus' => 'Belum Lunas',
                'lsp_id' => 3,
                'truck_first_id' => null,
                'truck_second_id' => null,
            ],
            [
                'noOffer' => 'OFF-' . Str::random(6),
                'lspName' => 'PT Lautan Berlian',
                'origin' => 'Semarang',
                'destination' => 'Makassar',
                'shipmentMode' => 'D2P',
                'shipmentType' => 'FCL',
                'loadingDate' => now()->addDays(1),
                'shippingDate' => now()->addDays(3),
                'estimationDate' => now()->addDays(8),
                'maxWeight' => 25000,
                'maxVolume' => 50,
                'remainingWeight' => 25000,
                'remainingVolume' => 50,
                'commodities' => 'Alat Berat',
                'address' => 'Jl. Pandanaran No.7',
                'status' => 'Loading Item',
                'price' => 8000000,
                'totalAmount' => 8000000,
                'remainingAmount' => 8000000,
                'paidAmount' => 0,
                'paymentStatus' => 'Belum Lunas',
                'lsp_id' => 4,
                'truck_first_id' => null,
                'truck_second_id' => null,
            ],
            [
                'noOffer' => 'OFF-' . Str::random(6),
                'lspName' => 'PT Transindo',
                'origin' => 'Surabaya',
                'destination' => 'Bali',
                'shipmentMode' => 'P2P',
                'shipmentType' => 'LCL',
                'loadingDate' => now()->addDays(4),
                'shippingDate' => now()->addDays(6),
                'estimationDate' => now()->addDays(11),
                'maxWeight' => 5000,
                'maxVolume' => 8,
                'remainingWeight' => 5000,
                'remainingVolume' => 8,
                'commodities' => 'Makanan',
                'address' => 'Jl. Diponegoro No.88',
                'status' => 'On The Way',
                'price' => 2000000,
                'totalAmount' => 2000000,
                'remainingAmount' => 500000,
                'paidAmount' => 1500000,
                'paymentStatus' => 'Belum Lunas',
                'lsp_id' => 5,
                'truck_first_id' => null,
                'truck_second_id' => null,
            ],
            [
                'noOffer' => 'OFF-' . Str::random(6),
                'lspName' => 'PT Cahaya Timur',
                'origin' => 'Medan',
                'destination' => 'Aceh',
                'shipmentMode' => 'D2D',
                'shipmentType' => 'FCL',
                'loadingDate' => now()->addDays(5),
                'shippingDate' => now()->addDays(7),
                'estimationDate' => now()->addDays(12),
                'maxWeight' => 12000,
                'maxVolume' => 20,
                'remainingWeight' => 12000,
                'remainingVolume' => 20,
                'commodities' => 'Barang Konstruksi',
                'address' => 'Jl. Sisingamangaraja No.10',
                'status' => 'Finished',
                'price' => 4500000,
                'totalAmount' => 4500000,
                'remainingAmount' => 0,
                'paidAmount' => 4500000,
                'paymentStatus' => 'Lunas',
                'lsp_id' => 6,
                'truck_first_id' => null,
                'truck_second_id' => null,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
        
    }
}
