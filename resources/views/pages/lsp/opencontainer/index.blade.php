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
        text-align: center;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <h2 class="mb-4">Open Container</h2>
        <div class="search-container">
        <form action="{{ route('opencontainer.index') }}" method="GET" class="search-holder">
            <input type="text" name="origin" class="form-control" placeholder="Asal Kota, Pelabuhan, Negara"
                style="width: 500px; border-radius:10px" value="{{ request('origin') }}">

            <input type="text" name="destination" class="form-control" placeholder="Tujuan Kota, Pelabuhan, Negara"
                style="width: 500px; border-radius:10px" value="{{ request('destination') }}">

            <input type="date" name="shippingDate" class="form-control w-auto" style="border-radius:10px"
                value="{{ request('shippingDate') }}">

            <div style="border-right: 2px solid rgba(0, 0, 0, 0.25)"></div>

            <!-- Tombol Filter Laut & Darat -->
            <div class="btn-group">
                <input type="hidden" name="shipmentMode" id="shipmentMode" value="{{ request('shipmentMode', '') }}">
                <button type="button" class="btn {{ request('shipmentMode') == 'laut' ? 'btn-primary' : 'btn-outline-primary' }}" id="filter-sea">
                    <i class="fas fa-ship"></i> Laut
                </button>
                <button type="button" class="btn {{ request('shipmentMode') == 'darat' ? 'btn-primary' : 'btn-outline-primary' }}" id="filter-land">
                    <i class="fas fa-truck"></i> Darat
                </button>
            </div>

            <div style="border-right: 2px solid rgba(0, 0, 0, 0.25);"></div>

            <!-- Tombol Cari -->
            <button type="submit" class="btn btn-primary" style="border-radius: 10px">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>
    </div>
    <div class="mt-4">
        @if(!$searchPerformed)
            {{-- Tampilan Awal --}}
            <div id="result-container" class="text-center mt-5">
                <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Cari" width="100">
                <h3 class="mt-3">Cari untuk memulai!</h3>
                <p>Masukkan Asal dan Tujuan untuk memulai</p>
            </div>
        @elseif ($offers->isEmpty())
            {{-- Jika Tidak Ada Hasil Pencarian --}}
            <div class="card text-center p-4">
                <div class="card-body">
                    <img src="{{ asset('template/mantis/dist/assets/images/unavailable_icon.png') }}" alt="No Result" class="mb-3" style="max-width: 100px;">
                    <h3 class="mb-2">Rute tidak tersedia</h3>
                    <p class="text-muted">Buat permintaan rute pengiriman baru</p>
                    <a href="/request-routes" class="btn btn-primary w-50">Buat Permintaan</a>
                </div>
            </div>
        @else
            {{-- Jika Ada Hasil Pencarian --}}
            @foreach ($offers as $item)
            <div class="card card-hover mb-3">
                <div class="card-body">
                    {{-- Bagian Header (LSP Info) --}}
                    <div class="row align-items-center">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="me-2">
                                <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('template/mantis/dist/assets/images/user/avatar-2.jpg') }}"
                                    alt="profile-lsp"
                                    class="user-avatar wid-35 rounded-circle">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold">{{ $item->lspName }}</h5>
                                <i class="fas fa-star text-warning"></i>
                                <h5 class="mb-0 fw-bold">{{ $item->user->rating ?? '0.0' }}</h5>
                            </div>
                        </div>

                        {{-- Shipment Mode & Type --}}
                        <div class="col-md-4 d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti {{ $item->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"></i>
                                {{ ucfirst($item->shipmentMode) }}
                            </button>
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i> {{ $item->shipmentType }}
                            </button>
                        </div>

                        {{-- Copy Button --}}
                        <div class="col-md-2 d-flex align-items-center gap-2 text-end" style="justify-content: flex-end">
                            <h5 class="mb-0">{{$item->id}}</h5>
                            <button type="button" class="btn btn-icon btn-light-primary">
                                <i class="ti ti-copy"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Rute Pengiriman --}}
                    <div class="row align-items-center mt-3">
                        <div class="col-md-8 d-flex align-items-center justify-content-start">
                            <h5 class="mb-0 fw-bold">{{ $item->origin }}</h5>
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <i class="ti ti-clock text-primary"></i>
                                <h5 class="mb-0 mx-2 text-primary">{{ $item->estimated_days }} Hari</h5>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                            </div>
                            <h5 class="mb-0 fw-bold">{{ $item->destination }}</h5>
                        </div>

                        {{-- Harga & Pilih Button --}}
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item->price, 0, ',', '.') }}</h4>
                                <h5 class="mb-0 ms-2">/CBM</h5>
                            </div>
                            <a href="/search-routes/{{ $item->id }}" class="btn btn-primary w-50">Pilih</a>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-md-8 d-flex align-items-center justify-content-start">
                            <h5 class="mb-0 fw-bold">Loading Date : {{ \Carbon\Carbon::parse($item->loadingDate)->format('d-m-y') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.getElementById('filter-sea').addEventListener('click', function() {
        document.getElementById('shipmentMode').value = 'laut';
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-primary');
        document.getElementById('filter-land').classList.add('btn-outline-primary');
        document.getElementById('filter-land').classList.remove('btn-primary');
    });

    document.getElementById('filter-land').addEventListener('click', function() {
        document.getElementById('shipmentMode').value = 'darat';
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-primary');
        document.getElementById('filter-sea').classList.add('btn-outline-primary');
        document.getElementById('filter-sea').classList.remove('btn-primary');
    });
</script>

@endsection
