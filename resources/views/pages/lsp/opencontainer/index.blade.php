@extends('layouts.app')

@section('content')
@section('title', 'Open Container')
@php
    \Carbon\Carbon::setLocale('id');
@endphp
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
    .modal-header{
        justify-content: center;
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
            <div class="card card-hover mb-3" style="border-radius: 10px">
                <div class="card-body" >
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
                            <h5 class="mb-0">ID : {{$item->id}}</h5>
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
                            {{-- <a href="/search-routes/{{ $item->id }}" class="btn btn-primary w-50">Pilih</a> --}}
                            <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">Pilih</button>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-md-8 d-flex align-items-center justify-content-start">
                            <h5 class="mb-0 fw-bold">Loading Date : {{ \Carbon\Carbon::parse($item->loadingDate)->translatedFormat('l, d F Y')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Detail -->
            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel{{ $item->id }}">Detail Kontainer</h5>
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                        <div class="modal-body">
                            <p><strong>Penyedia Jasa :</strong> {{ $item->lspName }}</p>
                            <p><strong>ID :</strong> {{ $item->id }}</p>
                            <hr>
                            <div>
                                <p><strong>Kontainer Dibuka Untuk :</strong></p>
                                <p>{{ $item->commodities }}</p>
                            </div>
                            <div style="display: flex; justify-content:space-between">
                                <p><strong>Mode Pengiriman : </strong></p>
                                <i class="ti {{ $item->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"> {{ ucfirst($item->shipmentMode) }}</i>
                            </div>
                            <div style="display: flex; justify-content:space-between">
                                <p><strong>Tipe Pengiriman : </strong></p>
                                <p> {{$item->shipmentType}} </p>
                            </div>
                            <p><strong>Asal Pengiriman :</strong></p>
                            <p>{{ $item->origin }}</p>
                            <p><strong>Tujuan Pengiriman :</strong></p>
                            <p>{{ $item->destination }}</p>
                            <hr>
                            <div style="display: flex; justify-content:space-between">
                                <p><strong>Tanggal Muat :</strong></p>
                                <p>{{ \Carbon\Carbon::parse($item->loadingDate)->translatedFormat('l, d F Y')}}</p>
                            </div>
                            <div style="display: flex; justify-content:space-between">
                                <p><strong>Tanggal Pengiriman :</strong></p>
                                <p>{{ \Carbon\Carbon::parse($item->shippingDate)->translatedFormat('l, d F Y')}}</p>
                            </div>
                            <div style="display: flex; justify-content:space-between">
                                <p><strong>Estimasi Pengiriman :</strong></p>
                                <p>{{ \Carbon\Carbon::parse($item->shippingDate)->diffInDays(\Carbon\Carbon::parse($item->estimationDate)) }} Hari</p>
                            </div>
                            <hr>
                            <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                                <p><strong>Harga:</strong></p>
                                <p>Rp. {{ number_format($item->price, 0, ',', '.') }} / CBM</p>
                            </div>
                            <hr>
                            <h5 style="margin-bottom:20px">Detail Kargo</h5>
                            <div style="display: flex; justify-content:space-between">
                                <p>Berat Maksimal : </p>
                                <p>{{$item->maxWeight}} Kg </p>
                            </div>
                            <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                                <p>Volume Maksimal : </p>
                                <p>{{$item->maxVolume}} CBM </p>
                            </div>
                            <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                                <p>Berat Tersisa : </p>
                                <p><span style="color:#007bff ;">{{$item->remainingWeight}} </span> / {{$item->maxWeight}} Kg</p>
                            </div>
                            <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                                <p>Volume Tersisa : </p>
                                <p><span style="color:#007bff ;">{{$item->remainingVolume}} </span> / {{$item->maxVolume}} CBM</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" type="button" class="btn btn-primary w-50" data-bs-dismiss="modal">Ajukan Penawaran</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
