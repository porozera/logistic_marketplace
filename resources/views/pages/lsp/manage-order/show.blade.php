@extends('layouts.app')
@section('title', 'Detail Order')
@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="pc-container">
        <div class="pc-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="mb-0">Detail Order - {{ $order->noOffer }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('order-management.index') }}">Order Management</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Detail Order</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Detail Card -->
            <div class="card card-hover mb-4 shadow-sm p-3" style="border-radius: 10px">
                <div class="card-body">
                    <!-- Header Row -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 d-flex align-items-center justify-content-start">
                            <h4 class="mb-0">
                                No Offer: <span class="text-primary">{{ $order->noOffer }}</span>
                            </h4>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-start">
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                        \Carbon\Carbon::parse($order->pickupDate),
                                        false,
                                    );
                                    $daysLeft = ceil($daysLeft);
                                @endphp
                                @if ($daysLeft > 0)
                                    <h4 class=" bg-primary text-light " style="border-radius: 30px; padding:5px">Muat dalam
                                        {{ $daysLeft }} hari</h4>
                                @elseif ($daysLeft == 0)
                                    <h4 class=" bg-primary text-dark " style="border-radius: 30px; padding:5px">Muat Hari
                                        ini</h4>
                                @else
                                    <h4 class=" bg-danger text-dark " style="border-radius: 30px; padding:5px">Lewat
                                        {{ abs($daysLeft) }} hari</h4>
                                @endif
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-end">
                            <h4 class="mb-0">
                                ID: <span class="text-primary">{{ $order->id }}</span>
                            </h4>
                        </div>
                    </div>

                    <hr class="text-primary" style="border: 1px solid #007bff; border-radius: 5px;">

                    <!-- Route and Transport Info -->
                    <div class="row align-items-center mt-3">
                        <div class="col-md-6 d-flex align-items-center justify-content-start">
                            <h5 class="mb-0 fw-bold">{{ $order->origin }}</h5>
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <i class="ti ti-clock text-primary"></i>
                                <h5 class="mb-0 mx-2 text-primary">{{ \Carbon\Carbon::parse($order->deliveryDate)->diffInDays(\Carbon\Carbon::parse($order->arrivalDate)) }}Hari
                                </h5>
                                <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                            </div>
                            <h5 class="mb-0 fw-bold">{{ $order->destination }}</h5>
                        </div>
                        <div class="col-md-6 gap-2 text-end d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti {{ $order->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"></i>
                                {{ ucfirst($order->shipmentMode) }}
                            </button>
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i>
                                {{ $order->shipmentType }}
                            </button>
                        </div>
                    </div>

                    <!-- Dates Info -->
                    <div class="row align-items-center mt-3">
                        <div class="col-md-6 align-items-center justify-content-start d-flex">
                            <div>
                                <h5 class="mb-0">Tanggal Muat:</h5>
                                <h5 class="mb-0 text-primary">
                                    {{ \Carbon\Carbon::parse($order->pickupDate)->translatedFormat('l, d F Y') }}
                                </h5>
                            </div>
                            <div class="ms-4">
                                <h5 class="mb-0">Tanggal Pengiriman:</h5>
                                <h5 class="mb-0 text-primary">
                                    {{ \Carbon\Carbon::parse($order->deliveryDate)->translatedFormat('l, d F Y') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-4">

            <!-- User Orders Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Daftar Pemesan</h5>
                        </div>
                        <div class="card-body">
                            @forelse($userOrders as $uo)
                                <div class="card mb-3 card-hover shadow-sm" style="border-radius: 10px">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Nama User:</strong> {{ $uo->username }}<br>
                                                <strong>Tanggal Pemesanan:</strong>
                                                {{ \Carbon\Carbon::parse($uo->created_at)->translatedFormat('d F Y H:i') }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Volume:</strong> {{ $uo->volume }} CBM<br>
                                                <strong>Berat:</strong> {{ $uo->weight }} KG
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning">
                                    <i class="ti ti-info-circle me-2"></i>
                                    Belum ada user yang memesan.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="row mt-4">
                <div class="col-12">
                    <a href="{{ route('order-management.index') }}" class="btn btn-primary">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
