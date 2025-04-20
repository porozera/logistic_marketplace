@extends('layouts.app')
@section('title', 'Open Container')
@section('content')
@php
    \Carbon\Carbon::setLocale('id');
@endphp
<div class="pc-container">
    <div class="pc-content">
        <h4 class="mb-4">Ajukan Penawaran - LCL</h4>
            <div class="card card-hover mb-3" style="border-radius: 10px">
                <div class="card-body" >
                    {{-- Bagian Header (LSP Info) --}}
                    <div class="row align-items-center">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="me-2">
                                <img src="{{ $offer->user->profilePicture ? asset('storage/' . $offer->user->profilePicture) : asset('template/mantis/dist/assets/images/user/avatar-2.jpg') }}"
                                    alt="profile-lsp"
                                    class="user-avatar wid-35 rounded-circle">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold">{{ $offer->lspName }}</h5>
                                <i class="fas fa-star text-warning"></i>
                                <h5 class="mb-0 fw-bold">{{ $offer->user->rating ?? '0.0' }}</h5>
                            </div>
                        </div>

                        {{-- Shipment Mode & Type --}}
                        <div class="col-md-4 d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti {{ $offer->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"></i>
                                {{ ucfirst($offer->shipmentMode) }}
                            </button>
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i> {{ $offer->shipmentType }}
                            </button>
                        </div>

                        {{-- Copy Button --}}
                        <div class="col-md-2 d-flex align-items-center gap-2 text-end" style="justify-content: flex-end">
                            <h4 class="text-primary fw-bold mb-0">ID : {{$offer->id}}</h4>
                            <button type="button" class="btn btn-icon btn-light-primary">
                                <i class="ti ti-copy"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Rute Pengiriman --}}
                    <div class="row align-items-center mt-3">
                        <div class="col-md-8 d-flex align-items-center justify-content-start">
                            <h5 class="mb-0 fw-bold">{{ $offer->origin }}</h5>
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <i class="ti ti-clock text-primary"></i>
                                <h5 class="mb-0 mx-2 text-primary">{{ $offer->estimated_days }} Hari</h5>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                            </div>
                            <h5 class="mb-0 fw-bold">{{ $offer->destination }}</h5>
                        </div>

                        {{-- Harga & Pilih Button --}}
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($offer->price, 0, ',', '.') }}</h4>
                                <h5 class="mb-0 ms-2">/CBM</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            {{-- Informasi dari Offer --}}
            <div class="col-md-6">
                <div class="card p-3">
                    <div style="display: flex; justify-content:space-between; align-items:flex-end">
                        <h5>Tanggal Muat Barang</h5>
                        <h4 class="mt-2 text-primary"><strong>{{ \Carbon\Carbon::parse($offer->loadingDate)->translatedFormat('l, d F Y') }}</strong></h4>
                    </div>
                    <hr>
                    <div style="display: flex; justify-content:space-between">
                        <p><strong>Mode Pengiriman : </strong></p>
                        <h5 class="text-primary">
                            <i class="ti {{ $offer->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"></i>
                            {{ ucfirst($offer->shipmentMode) }}
                        </h5>
                    </div>
                    <div style="display: flex; justify-content:space-between">
                        <p><strong>Tipe Pengiriman : </strong></p>
                        <h5 class="text-primary"> {{$offer->shipmentType}} </h5>
                    </div>
                    <p><strong>Asal Pengiriman :</strong></p>
                    <p>{{ $offer->origin }}</p>
                    <p><strong>Tujuan Pengiriman :</strong></p>
                    <p>{{ $offer->destination }}</p>
                    <hr>
                    <div style="display: flex; justify-content:space-between">
                        <p><strong>Tanggal Muat :</strong></p>
                        <p>{{ \Carbon\Carbon::parse($offer->loadingDate)->translatedFormat('l, d F Y')}}</p>
                    </div>
                    <div style="display: flex; justify-content:space-between">
                        <p><strong>Tanggal Pengiriman :</strong></p>
                        <p>{{ \Carbon\Carbon::parse($offer->shippingDate)->translatedFormat('l, d F Y')}}</p>
                    </div>
                    <div style="display: flex; justify-content:space-between">
                        <p><strong>Estimasi Pengiriman :</strong></p>
                        <p>{{ \Carbon\Carbon::parse($offer->shippingDate)->diffInDays(\Carbon\Carbon::parse($offer->estimationDate)) }} Hari</p>
                    </div>
                    <hr>
                    <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                        <p><strong>Harga:</strong></p>
                        <p>Rp. {{ number_format($offer->price, 0, ',', '.') }} / CBM</p>
                    </div>
                    <hr>
                    <h5 style="margin-bottom:20px">Detail Kargo</h5>
                    <div style="display: flex; justify-content:space-between">
                        <p>Berat Maksimal : </p>
                        <p>{{$offer->maxWeight}} Kg </p>
                    </div>
                    <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                        <p>Volume Maksimal : </p>
                        <p>{{$offer->maxVolume}} CBM </p>
                    </div>
                    <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                        <p>Berat Tersisa : </p>
                        <p><span style="color:#007bff ;">{{$offer->remainingWeight}} </span> / {{$offer->maxWeight}} Kg</p>
                    </div>
                    <div style="display: flex; justify-content:space-between; margin-bottom:0; ">
                        <p>Volume Tersisa : </p>
                        <p><span style="color:#007bff ;">{{$offer->remainingVolume}} </span> / {{$offer->maxVolume}} CBM</p>
                    </div>
                </div>
            </div>

            {{-- Form Ajukan --}}
            <div class="col-md-6">
                <form action="{{ route('opencontainer.store', $offer->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">

                    <div class="card p-3">
                        <h4>Form Pemesanan</h4>
                        <hr>
                        <div class="mb-3">
                            <label>Volume (CBM)</label>
                            <input type="number"
                            name="volume"
                            id="volumeInput"
                            class="form-control"
                            min="1"
                            max="{{ $offer->remainingVolume }}"
                            placeholder="Tersedia : {{ $offer->remainingVolume }} CBM"
                            required>
                            <div id="volumeWarning" class="text-danger mt-1" style="display: none;">
                                Invalid input. (1 - {{ $offer->remainingVolume }} CBM)
                            </div>
                            <div id="volumeInvalid" class="text-danger mt-1" style="display: none;">
                                Invalid
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>No Telepon</label>
                            <input type="text" name="telp" class="form-control" placeholder="+62xxxx">
                        </div>

                        <div class="mb-3">
                            <label>Tipe Barang</label>
                            <select name="itemType" class="form-select">
                                <option value="">Pilih tipe barang</option>
                                <option value="General">General</option>
                                <option value="Fragile">Barang Pecah Belah</option>
                                <option value="Perishable">Barang Mudah Rusak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi (Opsional)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
{{--
                        <div class="mb-3">
                            <label>Metode Pembayaran</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="paymentMethod" value="faktur" checked class="form-check-input">
                                <label class="form-check-label">Bayar dengan faktur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="paymentMethod" value="kredit" class="form-check-input">
                                <label class="form-check-label">Bayar dengan kredit</label>
                            </div>
                        </div> --}}

                        <div class="mb-3">
                            <label>Total Perkiraan Biaya</label>
                            <h5 class="text-primary" id="totalHargaDisplay">Rp 0 </h5>
                        </div>

                        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('volumeInput').addEventListener('input', function () {
        const input = this;
        const warning = document.getElementById('volumeWarning');
        const invalid = document.getElementById('volumeInvalid');
        const max = {{ $offer->remainingVolume }};

        if (parseInt(input.value) > max || parseInt(input.value) < 1) {
            warning.style.display = 'block';
            input.classList.add('is-invalid');
        }
        // else if (parseFloat(input.value) < 1){
        //     invalid.style.display = 'block';
        //     input.classList.add('is-invalid');
        // }
        else {
            warning.style.display = 'none';
            input.classList.remove('is-invalid');
        }
    });
        // Blokir input titik dan koma dari keyboard
        document.getElementById('volumeInput').addEventListener('keypress', function(e) {
        if (e.key === '.' || e.key === ',') {
            e.preventDefault();
        }
    });
    const volumeInput = document.getElementById('volumeInput');
    const totalHargaDisplay = document.getElementById('totalHargaDisplay');
    const pricePerCBM = {{ $offer->price }}; // harga per CBM

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    volumeInput.addEventListener('input', function () {
        const volume = parseFloat(this.value);

        if (!isNaN(volume) && volume > 0) {
            const total = volume * pricePerCBM;
            totalHargaDisplay.textContent = formatRupiah(total);
        } else {
            totalHargaDisplay.textContent = "Rp 0";
        }
    });
</script>
@endsection
