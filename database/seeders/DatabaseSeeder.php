<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'firstName' => 'Admin',
            'lastName' => 'User',
            'role' => 'admin',
            'telpNumber' => '08123456789',
            'profilePicture' => null,
            'description' => 'Ini adalah akun admin utama.',
            'rating' => 5.0,
            'address' => 'Jl. Admin No. 1, Jakarta',
            'companyName' => 'PT xyz',
            'bannerPicture' => null,
        ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(OffersSeeder::class);

        $this->call([
            CustomerSeeder::class,
        ]);
    }
 
}
