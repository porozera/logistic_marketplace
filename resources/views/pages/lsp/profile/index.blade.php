@extends('layouts.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- Banner -->
        <div style="background: url('{{ asset('storage/' . $user->bannerPicture) }}') no-repeat center center; background-size: cover; height: 250px;">
        </div>

        <!-- Profile Details -->
        <div class="text-center mt-4">
            <h2>{{ $user->companyName ?? 'Nama Perusahaan' }}</h2>
            <div class="d-flex justify-content-center align-items-center">
                @for ($i = 0; $i < floor($user->rating); $i++)
                    ⭐
                @endfor
            </div>
            <div style="margin-top: 10px">
                <span class="ml-2">({{ $user->rating ?? '0' }} ulasan)</span>
            </div>
            <p class="mt-2">{{ $user->description ?? 'Deskripsi perusahaan belum tersedia.' }}</p>
        </div>

        <!-- Company Stats -->
        <div class="d-flex justify-content-around mt-4">
            <div>🚚 570 Pengiriman Berhasil</div>
            <div>🚗 30 Kendaraan Aktif</div>
            <div>⛴️ 14 Armada Kapal</div>
        </div>

        <!-- Payment Methods -->
        <h4 class="mt-5" style="text-align:center; margin-bottom:50px">Menyediakan Pembayaran</h4>
        <div class="d-flex justify-content-around mt-3">
            <img src="{{ asset('images/mandiri.jpg') }}" alt="Mandiri" width="250" height="140" style="border-radius: 20px">
            <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" width="250" height="140" style="border-radius: 20px">
            <img src="{{ asset('images/bri.png') }}" alt="BRI" width="250" height="140" style="border-radius: 20px">
            <img src="{{ asset('images/dana.png') }}" alt="Dana" width="250" height="140" style="border-radius: 20px">
        </div>

        <!-- Customer Reviews -->
        <h4 class="mt-5" style="text-align:center; margin-bottom:50px">Review Pelanggan</h4>
        <div class="d-flex justify-content-around mt-3">
            <div class="card p-3" style="width: 30%;">
                <p>"Layanan dari LSP ini sangat memuaskan..."</p>
                <small>⭐ ⭐ ⭐ ⭐ ⭐ - Matt Murdock</small>
            </div>
            <div class="card p-3" style="width: 30%;">
                <p>"Saya cukup puas dengan LSP ini..."</p>
                <small>⭐ ⭐ ⭐ ⭐ ⭐ - Nina Amilah</small>
            </div>
            <div class="card p-3" style="width: 30%;">
                <p>"Saya sudah beberapa kali menggunakan layanan ini..."</p>
                <small>⭐ ⭐ ⭐ ⭐ ⭐ - Summer Mayers</small>
            </div>
        </div>
    </div>
</div>
@endsection
