<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RequestRouteSeeder extends Seeder
{
    public function run()
    {
        $request_routes = [
            [
                'origin' => 'KOTA JAKARTA UTARA', 
                'destination' => 'KOTA JAYAPURA',
                'shipmentMode' => 'D2D',
                'shipmentType' => 'LCL',
                'transportationMode' => 'laut',
                'arrivalDate' => Carbon::now()->addDays(9),
                'deadline' => Carbon::now()->addDays(7),
                'cargoType' => 'General Cargo',
                'status' => 'active',
                'description' => "Tidak ada pesan",
                'user_id' => 3,
                'container_id' => 1,
            ],
        ];

        DB::table('request_routes')->insert($request_routes);
    }
}
