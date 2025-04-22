@extends('layouts.app')

@section('title', 'Pengiriman')

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
                            <li class="breadcrumb-item" aria-current="page">Detail Pengiriman</li>
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
                    <!-- Kiri -->
                    <div class="col-lg-6">
                        @foreach ([
                            'noOffer' => 'No Offer',
                            'lspName' => 'Pengirim',
                            'origin' => 'Asal',
                            'destination' => 'Tujuan',
                            'shipmentMode' => 'Moda Pengiriman',
                            'shipmentType' => 'Tipe Pengiriman',
                            'loadingDate' => 'Tanggal Loading',
                            'shippingDate' => 'Tanggal Pengiriman',
                            'estimationDate' => 'Estimasi Tiba',
                            'maxWeight' => 'Berat Maksimal',
                            'maxVolume' => 'Volume Maksimal'
                        ] as $field => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" value="{{ $shipment->$field }}" disabled>
                            </div>
                        @endforeach
                    </div>

                    <!-- Kanan -->
                    <div class="col-lg-6">
                        @foreach ([
                            'remainingWeight' => 'Sisa Berat',
                            'remainingVolume' => 'Sisa Volume',
                            'commodities' => 'Komoditas',
                            'status' => 'Status Pengiriman',
                            'price' => 'Harga',
                            'totalAmount' => 'Total Biaya',
                            'remainingAmount' => 'Sisa Tagihan',
                            'paidAmount' => 'Jumlah Dibayar',
                            'paymentStatus' => 'Status Pembayaran'
                        ] as $field => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" value="{{ $shipment->$field ?? '-' }}" disabled>
                            </div>
                        @endforeach
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
