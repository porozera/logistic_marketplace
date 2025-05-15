<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OffersSeeder extends Seeder
{
    public function run()
    {
        $offers = [
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP A',
                'origin' => 'KOTA JAKARTA UTARA', 
                'destination' => 'KOTA PADANG',
                'shipmentMode' => 'D2D',
                'shipmentType' => 'LCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(2),
                'estimationDate' => Carbon::now()->addDays(5),
                'maxWeight' => 100000,
                'maxVolume' => 33,
                'remainingWeight' => 100000,
                'remainingVolume' => 33,
                'commodities' => 'Elektronik',
                'cargoType' => 'General Cargo',
                'status' => 'active',
                'price' => 1500000.00,
                'user_id' => 2,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => 1,
                'truck_second_id' => 2
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP B',
                'origin' => 'KABUPATEN BANDUNG',
                'destination' => 'KOTA DENPASAR',
                'shipmentMode' => 'D2P',
                'shipmentType' => 'FCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(3),
                'estimationDate' => Carbon::now()->addDays(6),
                'maxWeight' => 150000,
                'maxVolume' => 33,
                'remainingWeight' => 150000,
                'remainingVolume' => 33,
                'commodities' => 'Hewan',
                'cargoType' => 'Special Cargo',
                'status' => 'active',
                'price' => 2000000.00,
                'user_id' => 2,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => 1,
                'truck_second_id' => null
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP C',
                'origin' => 'KOTA MEDAN',
                'destination' => 'KOTA JAKARTA UTARA',
                'shipmentMode' => 'P2P',
                'shipmentType' => 'LCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(1),
                'estimationDate' => Carbon::now()->addDays(4),
                'maxWeight' => 120000,
                'maxVolume' => 33,
                'remainingWeight' => 120000,
                'remainingVolume' => 33,
                'commodities' => 'Senjata',
                'cargoType' => 'Dangerous Cargo',
                'status' => 'active',
                'price' => 1700000.00,
                'user_id' => 2,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => null,
                'truck_second_id' => null
            ],
        ];

        DB::table('offers')->insert($offers);
    }
}
