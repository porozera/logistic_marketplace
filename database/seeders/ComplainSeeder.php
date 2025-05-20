<?php

namespace Database\Seeders;

use App\Models\Complain;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ComplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $complains = [
            [
                'username' => 'Andi',
                'email' => 'andi@gmail.com',
                'description' => 'Saya mengalami masalah saat melakukan pembayaran.',
                'status' => 'Pending',
            ],
            [
                'username' => 'Budi',
                'email' => 'budi@gmail.com',
                'description' => 'Pengiriman saya terlambat dari jadwal.',
                'status' => 'Pending',
            ],
            [
                'username' => 'Citra',
                'email' => 'citra@gmail.com',
                'description' => 'Kontainer yang dikirim dalam kondisi rusak.',
                'status' => 'Solved',
            ],
            [
                'username' => 'Dewi',
                'email' => 'dewi@gmail.com',
                'description' => 'Tidak bisa mengakses akun saya.',
                'status' => 'Solved',
            ],
            [
                'username' => 'Eko',
                'email' => 'eko@gmail.com',
                'description' => 'Harga tiba-tiba berubah saat checkout.',
                'status' => 'Pending',
            ],
            [
                'username' => 'Fajar',
                'email' => 'fajar@gmail.com',
                'description' => 'Driver tidak profesional saat pengiriman.',
                'status' => 'Solved',
            ],
            [
                'username' => 'Gita',
                'email' => 'gita@gmail.com',
                'description' => 'Saya tidak mendapatkan faktur pembayaran.',
                'status' => 'Pending',
            ],
            [
                'username' => 'Hadi',
                'email' => 'hadi@gmail.com',
                'description' => 'Barang saya hilang saat proses pengiriman.',
                'status' => 'Pending',
            ],
            [
                'username' => 'Ika',
                'email' => 'ika@gmail.com',
                'description' => 'Sistem tracking tidak berfungsi.',
                'status' => 'Solved',
            ],
            [
                'username' => 'Joko',
                'email' => 'joko@gmail.com',
                'description' => 'Saya ingin membatalkan pesanan saya.',
                'status' => 'Solved',
            ],
        ];
        foreach ($complains as $complain) {
            Complain::create($complain);
        }
    }
}
