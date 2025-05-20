<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // General
            [
                'type' => 'General',
                'header' => 'Apa itu Logistic Marketplace?',
                'description' => 'Platform untuk menghubungkan pengguna dengan layanan logistik terpercaya.',
            ],
            [
                'type' => 'General',
                'header' => 'Bagaimana cara membuat akun?',
                'description' => 'Klik tombol daftar, isi formulir pendaftaran, dan verifikasi email Anda.',
            ],
            [
                'type' => 'General',
                'header' => 'Apakah tersedia aplikasi mobile?',
                'description' => 'Saat ini tersedia untuk Android dan segera hadir untuk iOS.',
            ],

            // Peralatan
            [
                'type' => 'Peralatan',
                'header' => 'Apa saja jenis kontainer yang tersedia?',
                'description' => 'Tersedia kontainer standar, reefer, dan open-top untuk berbagai kebutuhan pengiriman.',
            ],
            [
                'type' => 'Peralatan',
                'header' => 'Bagaimana cara memilih kontainer?',
                'description' => 'Pilih berdasarkan jenis barang, berat, dan volume pengiriman Anda.',
            ],
            [
                'type' => 'Peralatan',
                'header' => 'Apakah tersedia layanan sewa alat berat?',
                'description' => 'Ya, kami menyediakan alat berat seperti forklift dan crane untuk keperluan logistik.',
            ],

            // Harga & Pembayaran
            [
                'type' => 'Harga & Pembayaran',
                'header' => 'Bagaimana cara menghitung biaya pengiriman?',
                'description' => 'Biaya dihitung berdasarkan jarak, berat, volume, dan jenis layanan.',
            ],
            [
                'type' => 'Harga & Pembayaran',
                'header' => 'Metode pembayaran apa yang diterima?',
                'description' => 'Kami menerima transfer bank, kartu kredit, dan pembayaran digital.',
            ],
            [
                'type' => 'Harga & Pembayaran',
                'header' => 'Apakah bisa membayar secara bertahap?',
                'description' => 'Ya, tersedia opsi pembayaran DP dan pelunasan setelah pengiriman.',
            ],

            // Pengiriman
            [
                'type' => 'Pengiriman',
                'header' => 'Berapa lama waktu pengiriman?',
                'description' => 'Waktu pengiriman tergantung jarak dan moda transportasi yang dipilih.',
            ],
            [
                'type' => 'Pengiriman',
                'header' => 'Bagaimana melacak status pengiriman?',
                'description' => 'Gunakan fitur pelacakan di dashboard untuk melihat status pengiriman Anda.',
            ],
            [
                'type' => 'Pengiriman',
                'header' => 'Apa yang terjadi jika barang terlambat dikirim?',
                'description' => 'Kami akan menginformasikan estimasi baru dan memberikan kompensasi sesuai kebijakan.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
