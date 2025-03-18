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
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'shipmentMode' => 'laut',
                'shipmentType' => 'FCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(2),
                'estimationDate' => Carbon::now()->addDays(5),
                'maxWeight' => 100000,
                'maxVolume' => 50,
                'remainingWeight' => 100000,
                'remainingVolume' => 50,
                'commodities' => 'Electronics',
                'status' => 'active',
                'price' => 1500000.00,
                'user_id' => 1,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP B',
                'origin' => 'Bandung',
                'destination' => 'Medan',
                'shipmentMode' => 'darat',
                'shipmentType' => 'LCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(3),
                'estimationDate' => Carbon::now()->addDays(6),
                'maxWeight' => 150000,
                'maxVolume' => 60,
                'remainingWeight' => 150000,
                'remainingVolume' => 60,
                'commodities' => 'Furniture',
                'status' => 'active',
                'price' => 2000000.00,
                'user_id' => 1,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => false,
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP C',
                'origin' => 'Semarang',
                'destination' => 'Bali',
                'shipmentMode' => 'laut',
                'shipmentType' => 'FCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(1),
                'estimationDate' => Carbon::now()->addDays(4),
                'maxWeight' => 120000,
                'maxVolume' => 55,
                'remainingWeight' => 120000,
                'remainingVolume' => 55,
                'commodities' => 'Textile',
                'status' => 'active',
                'price' => 1700000.00,
                'user_id' => 1,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => false,
                'is_for_customer' => true,
            ],
        ];

        DB::table('offers')->insert($offers);
    }
}
