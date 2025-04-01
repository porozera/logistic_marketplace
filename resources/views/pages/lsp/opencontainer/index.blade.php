@extends('layouts.app')

@section('content')
@section('title', 'Open Container')

<style>
    .search-container{
        background-color:white;
        padding: 10px;
        border-radius: 10px;
    }
    .search-holder{
        display: flex;
        justify-content: space-between;
    }
    .form-control {
    min-width: 220px;
    }
    .btn-group .btn {
        min-width: 100px;
    }
    .btn.active {
        background-color: #007bff;
        color: white;
    }
    #result-container img {
        opacity: 0.6;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <h2 class="mb-4">Open Container</h2>
        <div class="search-container">

        <!-- Form Pencarian -->
        <div class="search-holder">
            <input type="text" id="origin" class="form-control " placeholder="Asal Kota, Pelabuhan, Negara" style="width: 500px; border-radius:10px">
            <input type="text" id="destination" class="form-control " placeholder="Tujuan Kota, Pelabuhan, Negara" style="width: 500px; border-radius:10px">
            <input type="date" id="shippingDate" class="form-control w-auto" placeholder="Pilih Tanggal" style="border-radius:10px">
            <div style="border-right: 2px solid rgba(0, 0, 0, 0.25)"></div>
            <!-- Tombol Filter Laut & Darat -->
            <div class="btn-group"  >
                <button type="button" class="btn btn-outline-primary" id="filter-sea">
                    <i class="fas fa-ship"></i> Laut
                </button>
                <button type="button" class="btn btn-outline-primary" id="filter-land">
                    <i class="fas fa-truck"></i> Darat
                </button>
            </div>

            <div style="border-right: 2px solid rgba(0, 0, 0, 0.25);"></div>
            <!-- Tombol Cari -->
            <button id="search-btn" class="btn btn-primary" style="border-radius: 10px">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>

    </div>
    <!-- Hasil Pencarian -->
    <div id="result-container" class="text-center mt-5">
        <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Cari" width="100">
        <h3 class="mt-3">Cari untuk memulai!</h3>
        <p>Masukkan Asal dan Tujuan untuk memulai</p>
    </div>
    </div>
</div>

<script>
document.getElementById('search-btn').addEventListener('click', function() {
    let origin = document.getElementById('origin').value;
    let destination = document.getElementById('destination').value;
    let shippingDate = document.getElementById('shippingDate').value;
    let filterMode = document.querySelector('.btn-group .active') ? document.querySelector('.btn-group .active').dataset.mode : '';

    fetch(`{{ route('opencontainer.search') }}?origin=${origin}&destination=${destination}&shippingDate=${shippingDate}&shipmentMode=${filterMode}`)
        .then(response => response.json())
        .then(data => {
            let resultContainer = document.getElementById('result-container');
            resultContainer.innerHTML = ''; // Kosongkan hasil pencarian sebelumnya

            if (data.length) {
                data.forEach(offer => {
                    let card = `
                        <div class="card mb-3 shadow-sm p-3 rounded" style="border-left: 5px solid #007bff;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><strong>${offer.lspName}</strong></h5>
                                    <span class="text-muted">${offer.origin} ➝ ${offer.destination}</span>
                                </div>
                                <span class="badge bg-primary">${offer.shipmentMode.toUpperCase()}</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Estimasi Tiba</small>
                                    <p class="mb-0">${offer.estimationDate}</p>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">Harga</small>
                                    <h5 class="text-primary">Rp. ${offer.price.toLocaleString()}</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <a href="/open-container/detail/${offer.id}" class="btn btn-sm btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                    resultContainer.innerHTML += card;
                });
            } else {
                resultContainer.innerHTML = `<p class="text-muted">Tidak ada hasil ditemukan</p>`;
            }
        });
});


// Toggle Filter Laut & Darat
document.getElementById('filter-sea').addEventListener('click', function() {
    this.classList.toggle('active');
    document.getElementById('filter-land').classList.remove('active');
});
document.getElementById('filter-land').addEventListener('click', function() {
    this.classList.toggle('active');
    document.getElementById('filter-sea').classList.remove('active');
});
</script>

@endsection
