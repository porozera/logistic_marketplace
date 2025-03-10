<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'firstName' => 'Customer',
            'lastName' => 'User',
            'role' => 'customer',
            'telpNumber' => '08129876543',
            'profilePicture' => null,
            'description' => 'Ini adalah akun customer.',
            'rating' => 4.5,
            'address' => 'Jl. Customer No. 2, Jakarta',
            'companyName' => null,
            'bannerPicture' => null,
        ]);
    }
}
