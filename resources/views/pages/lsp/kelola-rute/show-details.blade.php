@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Detail Offer')

@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="pc-container">
        <div class="pc-content">
            <div class="card">
                <div class="">
                        <div class="card shadow rounded">
                            <div class="card-header text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Penawaran - {{ $offer->noOffer }}</h5>
                                <a href="{{ route('offers.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                            </div>

                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Kolom 1 -->
                                    <div class="col-md-6">
                                        <h6>Informasi Umum</h6>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item"><strong>No. Penawaran:</strong> {{ $offer->noOffer }}</li>
                                            <li class="list-group-item"><strong>Asal:</strong> {{ $offer->origin }}</li>
                                            <li class="list-group-item"><strong>Tujuan:</strong> {{ $offer->destination }}</li>
                                            <li class="list-group-item"><strong>Port Asal:</strong> {{ $offer->portOrigin }}</li>
                                            <li class="list-group-item"><strong>Port Tujuan:</strong> {{ $offer->portDestination }}</li>
                                            <li class="list-group-item"><strong>Shipment Mode:</strong> {{ $offer->shipmentMode }}</li>
                                            <li class="list-group-item"><strong>Transportation Mode:</strong> {{ $offer->transportationMode }}</li>
                                            <li class="list-group-item"><strong>Shipment Type:</strong> {{ $offer->shipmentType }}</li>
                                            <li class="list-group-item"><strong>Status:</strong>
                                                <span class="badge {{ $offer->status == 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($offer->status) }}</span>
                                            </li>
                                            <li class="list-group-item"><strong>Harga:</strong> Rp {{ number_format($offer->price, 2, ',', '.') }} /CBM</li>
                                        </ul>
                                    </div>

                                    <!-- Kolom 2 -->
                                    <div class="col-md-6">
                                        <h6>Detail Pengiriman</h6>
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item"><strong>Pickup Date:</strong> {{ $offer->pickupDate }}</li>
                                            <li class="list-group-item"><strong>Departure Date:</strong> {{ $offer->departureDate }}</li>
                                            <li class="list-group-item"><strong>CY Closing Date:</strong> {{ $offer->cyClosingDate }}</li>
                                            <li class="list-group-item"><strong>ETD:</strong> {{ $offer->etd }}</li>
                                            <li class="list-group-item"><strong>ETA:</strong> {{ $offer->eta }}</li>
                                            <li class="list-group-item"><strong>Delivery Date:</strong> {{ $offer->deliveryDate }}</li>
                                            <li class="list-group-item"><strong>Arrival Date:</strong> {{ $offer->arrivalDate }}</li>
                                            <li class="list-group-item"><strong>Max Weight:</strong> {{ $offer->maxWeight }} kg</li>
                                            <li class="list-group-item"><strong>Max Volume:</strong> {{ $offer->maxVolume }} CBM</li>
                                            <li class="list-group-item"><strong>Remaining Weight:</strong> {{ $offer->remainingWeight }} kg</li>
                                            <li class="list-group-item"><strong>Remaining Volume:</strong> {{ $offer->remainingVolume }} CBM</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Tambahan -->
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Informasi Tambahan</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item"><strong>Jenis Kargo:</strong> {{ $offer->cargoType }}</li>
                                            <li class="list-group-item"><strong>Untuk LSP:</strong> {{ $offer->is_for_lsp ? 'Ya' : 'Tidak' }}</li>
                                            <li class="list-group-item"><strong>Untuk Customer:</strong> {{ $offer->is_for_customer ? 'Ya' : 'Tidak' }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">Edit</a>

                                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus offer ini?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
