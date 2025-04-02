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
                'shipmentMode' => 'D2D',
                'shipmentType' => 'LCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(2),
                'estimationDate' => Carbon::now()->addDays(5),
                'maxWeight' => 100000,
                'maxVolume' => 33,
                'remainingWeight' => 100000,
                'remainingVolume' => 33,
                'commodities' => '',
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
                'shipmentMode' => 'D2P',
                'shipmentType' => 'FCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(3),
                'estimationDate' => Carbon::now()->addDays(6),
                'maxWeight' => 150000,
                'maxVolume' => 33,
                'remainingWeight' => 150000,
                'remainingVolume' => 33,
                'commodities' => '',
                'status' => 'active',
                'price' => 2000000.00,
                'user_id' => 1,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
            ],
            [
                'noOffer' => 'OFF'.Str::random(5),
                'lspName' => 'LSP C',
                'origin' => 'Semarang',
                'destination' => 'Bali',
                'shipmentMode' => 'P2P',
                'shipmentType' => 'LCL',
                'loadingDate' => Carbon::now(),
                'shippingDate' => Carbon::now()->addDays(1),
                'estimationDate' => Carbon::now()->addDays(4),
                'maxWeight' => 120000,
                'maxVolume' => 33,
                'remainingWeight' => 120000,
                'remainingVolume' => 33,
                'commodities' => '',
                'status' => 'active',
                'price' => 1700000.00,
                'user_id' => 1,
                'timestamp' => Carbon::now(),
                'is_for_lsp' => true,
                'is_for_customer' => true,
            ],
        ];

        DB::table('offers')->insert($offers);
    }
}
