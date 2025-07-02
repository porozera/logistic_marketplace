@extends('layouts.app')

@section('content')
    <style>
        /* Container utama menggunakan flexbox */
        .main-container {
            display: flex;
            gap: 20px;
            min-height: 100vh;
        }

        /* Bagian kiri untuk list */
        .left-section {
            flex: 1;
            min-width: 0; /* Mencegah overflow */
        }

        /* Bagian kanan untuk detail - sticky position */
        .right-section {
            flex: 0 0 350px; /* Fixed width 350px */
            position: sticky;
            top: 20px;
            height: fit-content;
            max-height: calc(100vh - 40px);
        }

        #detail-container {
            overflow-y: auto;
            border: 1px solid #0484C4;
            border-radius: 10px;
            background: white;
        }

        /* Responsive untuk tablet */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
            }

            .right-section {
                flex: none;
                position: relative;
                top: 0;
                height: auto;
                max-height: none;
            }
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .main-container {
                gap: 10px;
            }

            .right-section {
                flex: none;
            }
        }
    </style>

    <div class="pc-container">
        <div class="pc-content">
            <div class="">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Permintaan Pengiriman</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Container dengan Flexbox -->
                <div class="main-container">
                    <!-- Bagian Kiri (List Request Routes) -->
                    <div class="left-section">
                        <h2>Permintaan Pengiriman Rute Khusus</h2>
                        <div class="mb-3 d-flex">
                            <input type="text" class="form-control me-2" placeholder="Asal">
                            <input type="text" class="form-control me-2" placeholder="Tujuan">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                        {{-- @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif --}}

                        @foreach ($requests as $request)
                            <div class="card mb-3 p-3 border-primary" style="border-radius: 10px">
                                <div class="d-flex justify-content-between">
                                    <div style="display: flex; align-items:center">
                                        <img src="{{asset('default-profile.jpg')}}"
                                            alt="Profile Picture" class="rounded-circle border border-white"
                                            style="width: 43px; height: 43px; object-fit: cover;">
                                        <h4 style="margin-left: 10px; text-align:center"><i class="bi bi-building"></i>
                                            {{ $request->userName }}</h4>
                                    </div>
                                    <span>ID : {{ $request->id }}</span>
                                </div>
                                <hr style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                                <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi:</strong>
                                    {{ $request->shipmentMode }}</p>
                                <p><strong>Asal : </strong> {{ $request->origin }}</p>
                                <p><strong>Tujuan : </strong> {{ $request->destination }}</p>
                                <hr style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary lihat-detail" data-id="{{ $request->id }}"
                                        data-user="{{ $request->userName }}" data-origin="{{ $request->origin }}"
                                        data-destination="{{ $request->destination }}"
                                        data-mode="{{ $request->shipmentMode }}" data-date="{{ $request->shippingDate }}"
                                        data-weight="{{ $request->weight }}" data-volume="{{ $request->volume }}"
                                        data-commodities="{{ $request->commodities }}"
                                        data-status="{{ $request->status }}"
                                        data-description="{{ $request->description }}"
                                        style="border-radius: 10px; width: 250px">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bagian Kanan (Detail Permintaan) -->
                    <div class="right-section">
                        <h3>Detail Permintaan</h3>
                        <div id="detail-container" class="card p-3" style="display: none;">
                            <h3>Pengaju : <span id="detail-user"></span></h3>
                            <br>
                            <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi :</strong>
                                <span id="detail-mode"></span>
                            </p>
                            <p style="display:flex;justify-content:space-between"><strong>Lokasi Asal :</strong> <span
                                    id="detail-origin"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Lokasi Tujuan :</strong> <span
                                    id="detail-destination"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Tanggal Pengiriman :</strong>
                                <span id="detail-date"></span>
                            </p>
                            <hr style="border-top: 1px solid #0484C4; opacity:1">
                            <h5 style="margin-bottom: 20px">Detail Muatan</h5>
                            <p style="display:flex;justify-content:space-between"><strong>Berat :</strong> <span
                                    id="detail-weight"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Volume :</strong> <span
                                    id="detail-volume"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Komoditas :</strong> <span
                                    id="detail-commodities"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Status :</strong> <span
                                    id="detail-status"></span></p>
                            <p style="display:grid"><strong>Deskripsi</strong> <span id="detail-description"></span></p>
                            <div style="display:flex; justify-content:end">
                                <a id="btn-ajukan" class="btn btn-primary mt-5" style="border-radius:10px">Ajukan
                                    Penawaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".lihat-detail");
            const detailContainer = document.getElementById("detail-container");
            const btnAjukan = document.getElementById("btn-ajukan");

            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    let requestId = this.getAttribute("data-id");
                    document.getElementById("detail-user").textContent = this.getAttribute("data-user");
                    document.getElementById("detail-mode").textContent = this.getAttribute("data-mode");
                    document.getElementById("detail-origin").textContent = this.getAttribute("data-origin");
                    document.getElementById("detail-destination").textContent = this.getAttribute("data-destination");
                    document.getElementById("detail-date").textContent = this.getAttribute("data-date");
                    document.getElementById("detail-weight").textContent = this.getAttribute("data-weight") + " Kg";
                    document.getElementById("detail-volume").textContent = this.getAttribute("data-volume") + " CBM";
                    document.getElementById("detail-commodities").textContent = this.getAttribute("data-commodities");
                    document.getElementById("detail-status").textContent = this.getAttribute("data-status");
                    document.getElementById("detail-description").textContent = this.getAttribute("data-description");

                    btnAjukan.href = `/bids/create/${requestId}`;
                    detailContainer.style.display = "block";
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: true, // Menampilkan tombol "OK"
                confirmButtonText: "OK", // Label tombol
                confirmButtonColor: "#3085d6", // Warna tombol OK
            });
        @endif
    });
</script>

@endsection
