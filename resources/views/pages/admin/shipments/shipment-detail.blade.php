@extends('layouts.app')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.shipment.index') }}">Pengiriman</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Pengiriman</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail Data Pengiriman</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
                <h5>Informasi Pengiriman</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        @php
                            $fieldsLeft = [
                                'noOffer' => 'No Penawaran',
                                'origin' => 'Asal',
                                'destination' => 'Tujuan',
                                'portOrigin' => 'Pelabuhan Asal',
                                'portDestination' => 'Pelabuhan Tujuan',
                                'shipmentMode' => 'Moda Pengiriman',
                                'shipmentType' => 'Tipe Pengiriman',
                                'transportationMode' => 'Moda Transportasi',
                                'pickupDate' => 'Tanggal Pickup',
                                'departureDate' => 'Tanggal Keberangkatan',
                                'cyClosingDate' => 'CY Closing Date',
                                'etd' => 'ETD',
                            ];
                        @endphp

                        @foreach ($fieldsLeft as $key => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" value="{{ $shipment->$key ?? '-' }}" disabled>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label class="form-label">Truck Pertama</label>
                            <input type="text" class="form-control" value="{{ $shipment->truckFirst->plate_number ?? '-' }}" disabled>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Truck Kedua</label>
                            <input type="text" class="form-control" value="{{ $shipment->truckSecond->plate_number ?? '-' }}" disabled>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Container</label>
                            <input type="text" class="form-control" value="{{ $shipment->container->container_number ?? '-' }}" disabled>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        @php
                            $fieldsRight = [
                                'eta' => 'ETA',
                                'deliveryDate' => 'Tanggal Pengiriman',
                                'arrivalDate' => 'Tanggal Sampai',
                                'maxWeight' => 'Berat Maksimal',
                                'maxVolume' => 'Volume Maksimal',
                                'remainingWeight' => 'Sisa Berat',
                                'remainingVolume' => 'Sisa Volume',
                                'cargoType' => 'Tipe Kargo',
                                'status' => 'Status Pengiriman',
                                'price' => 'Harga',
                                'totalAmount' => 'Total Biaya',
                                'remainingAmount' => 'Sisa Tagihan',
                                'paidAmount' => 'Jumlah Dibayar',
                                'paymentStatus' => 'Status Pembayaran',
                            ];
                        @endphp

                        @foreach ($fieldsRight as $key => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" value="{{ $shipment->$key ?? '-' }}" disabled>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label class="form-label">Pengirim (LSP)</label>
                            <input type="text" class="form-control" value="{{ $shipment->lsp->name ?? '-' }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end mt-3">
                    <a href="{{ route('admin.shipment.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
