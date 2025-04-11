@extends('layouts.app')

@section('content')

<!-- Custom CSS -->
<style>
    .stat-card {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 15px 30px;
        border: 1px solid #ccc;
        border-radius: 50px;
        min-width: 250px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        background-color: #f8f9fa;
    }

    .stat-card i {
        font-size: 1.2rem;
    }
</style>
<div class="pc-container">
    <div class="pc-content">

        <a href="{{route('profile.edit') }}">Edit Profil</a>
        <!-- Banner Section -->
        <div class="position-relative" style="background: url('{{ asset('storage/' . $user->bannerPicture) }}') no-repeat center center; background-size: cover; height: 250px;">
            <!-- Profile Picture -->
            <div class="position-absolute top-50 start-50 translate-middle">
                <img src="{{ asset('storage/' . $user->profilePicture) }}" alt="Profile Picture"
                    class="rounded-circle border border-white"
                    style="width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>

        <!-- Company Details -->
        <div class="text-center mt-5">
            <h2>{{ $user->companyName ?? 'Nama Perusahaan' }}</h2>
            <div class="d-flex justify-content-center align-items-center">
                @for ($i = 0; $i < floor($user->rating); $i++)
                    ⭐
                @endfor
            </div>
            <span class="ml-2">({{ $user->rating ?? '0' }} ulasan)</span>
            <p class="mt-3">{{ $user->description ?? 'Deskripsi perusahaan belum tersedia.' }}</p>
        </div>
        <!-- Company Stats -->
        <div class="d-flex justify-content-around mt-4">
            <div class="stat-card text-center">
                <span>1000 Pengiriman Berhasil</span>
                <i class="fas fa-gift text-primary"></i>
            </div>
            <div class="stat-card text-center">
                <span>80 Kendaraan Aktif</span>
                <i class="fas fa-truck text-primary"></i>
            </div>
            <div class="stat-card text-center">
                <span>30 Armada Kapal</span>
                <i class="fas fa-ship text-primary"></i>
            </div>
        </div>

        <!-- Payment Methods -->
        <h4 class="mt-5 text-center mb-5">Menyediakan Pembayaran</h4>
        <div class="d-flex justify-content-around mt-3">
            <img src="{{ asset('images/mandiri.jpg') }}" alt="Mandiri" width="250" height="140" class="rounded">
            <img src="{{ asset('images/mastercard.png') }}" alt="MasterCard" width="250" height="140" class="rounded">
            <img src="{{ asset('images/bri.png') }}" alt="BRI" width="250" height="140" class="rounded">
            <img src="{{ asset('images/dana.png') }}" alt="Dana" width="250" height="140" class="rounded">
        </div>

        <!-- Customer Reviews -->
        <h4 class="mt-5 text-center mb-5">Review Pelanggan</h4>
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
