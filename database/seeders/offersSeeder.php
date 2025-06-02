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
                'origin' => 'KOTA JAKARTA UTARA', 
                'destination' => 'KOTA PADANG',
                'portOrigin' => 'TANJUNG PRIOK',
                'portDestination' => 'PORT OF PADANG',
                'shipmentMode' => 'D2D',
                'shipmentType' => 'LCL',
                'transportationMode' => 'laut',
                'pickupDate' => null,
                'cyClosingDate' => Carbon::now()->addDays(2),
                'etd' => Carbon::now()->addDays(5),
                'eta' => Carbon::now()->addDays(7),
                'deliveryDate' => Carbon::now()->addDays(8),
                'arrivalDate' => Carbon::now()->addDays(9),
                'maxWeight' => 10000,
                'maxVolume' => 33,
                'remainingWeight' => 10000,
                'remainingVolume' => 33,
                'cargoType' => 'General Cargo',
                'status' => 'active',
                'price' => 1500000.00,
                'user_id' => 2,
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => 1,
                'truck_second_id' => 2,
                'container_id' => 1
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'origin' => 'KOTA JAKARTA', 
                'destination' => 'KOTA SURABAYA',
                'portOrigin' => 'TANJUNG PRIOK',
                'portDestination' => 'PORT OF SURABAYA',
                'shipmentMode' => 'P2D',
                'shipmentType' => 'LCL',
                'transportationMode' => 'laut',
                'pickupDate' => null,
                'cyClosingDate' => Carbon::now()->addDays(2),
                'etd' => Carbon::now()->addDays(5),
                'eta' => Carbon::now()->addDays(7),
                'deliveryDate' => Carbon::now()->addDays(8),
                'arrivalDate' => Carbon::now()->addDays(9),
                'maxWeight' => 10000,
                'maxVolume' => 33,
                'remainingWeight' => 10000,
                'remainingVolume' => 33,
                'cargoType' => 'Special Cargo',
                'status' => 'active',
                'price' => 1500000.00,
                'user_id' => 2,
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => 1,
                'truck_second_id' => 2,
                'container_id' => 1
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'origin' => 'KOTA JAKARTA', 
                'destination' => 'KOTA ACEH',
                'portOrigin' => 'TANJUNG PRIOK',
                'portDestination' => 'PORT OF ACEH',
                'shipmentMode' => 'D2P',
                'shipmentType' => 'FCL',
                'transportationMode' => 'laut',
                'pickupDate' => Carbon::now(),
                'cyClosingDate' => Carbon::now()->addDays(4),
                'etd' => Carbon::now()->addDays(5),
                'eta' => Carbon::now()->addDays(7),
                'deliveryDate' => Carbon::now()->addDays(8),
                'arrivalDate' => Carbon::now()->addDays(9),
                'maxWeight' => 10000,
                'maxVolume' => 33,
                'remainingWeight' => 10000,
                'remainingVolume' => 33,
                'cargoType' => 'General Cargo',
                'status' => 'active',
                'price' => 1500000.00,
                'user_id' => 2,
                'is_for_lsp' => true,
                'is_for_customer' => true,
                'truck_first_id' => 1,
                'truck_second_id' => 2,
                'container_id' => 1
            ],
        ];

        DB::table('offers')->insert($offers);
    }
}
