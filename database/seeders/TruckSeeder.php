<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TruckSeeder extends Seeder
{
    public function run()
    {
        DB::table('trucks')->insert([
            [
                'user_id' => 2,
                'plateNumber' => 'B 1234 ABC',
                'type' => 'Trailer',
                'brand' => 'Hino',
                'yearBuilt' => 2020,
                'driverName' => 'Andi',
                'driverContact' => '08123456789',
                'color' => 'Merah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'plateNumber' => 'D 5678 XYZ',
                'type' => 'Wingbox',
                'brand' => 'Mitsubishi',
                'yearBuilt' => 2022,
                'driverName' => 'Budi',
                'driverContact' => '08987654321',
                'color' => 'Biru',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
