@extends('layouts.app')
@section('title', 'Manajemen Pesanan')
@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Order Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="mb-4">Order Management</h2>

            @if ($orders->isEmpty())
                <div class="text-center alert alert-info">Belum ada kontainer yang dipesan.</div>
            @endif

            @foreach ($orders as $order)
<div class="card card-hover mb-4 shadow-sm p-3" style="border-radius: 12px">
    <div class="card-body">
        <!-- Header Row -->
        <div class="row align-items-center mb-4">
            <div class="col-md-4 d-flex align-items-center justify-content-start">
                <h4 class="mb-0">
                    No Offer: <span class="text-primary">{{ $order->noOffer }}</span>
                </h4>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                @php
                    $daysLeft = \Carbon\Carbon::now()->diffInDays(
                        \Carbon\Carbon::parse($order->pickupDate),
                        false,
                    );
                    $daysLeft = ceil($daysLeft);
                @endphp
                @if ($daysLeft > 0)
                    <h5 class="bg-success text-white mb-0" style="border-radius: 25px; padding: 8px 16px;">
                        Muat dalam {{ $daysLeft }} hari
                    </h5>
                @elseif ($daysLeft == 0)
                    <h5 class="bg-warning text-dark mb-0" style="border-radius: 25px; padding: 8px 16px;">
                        Muat Hari ini
                    </h5>
                @else
                    <h5 class="bg-danger text-white mb-0" style="border-radius: 25px; padding: 8px 16px;">
                        Lewat {{ abs($daysLeft) }} hari
                    </h5>
                @endif
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-end">
                <h4 class="mb-0">
                    ID: <span class="text-primary">{{ $order->id }}</span>
                </h4>
            </div>
        </div>

        <hr class="text-primary" style="border: 2px solid #007bff; border-radius: 5px;">

        <!-- Route and Transport Info -->
        <div class="row align-items-center mt-4">
            <div class="col-md-8 d-flex align-items-center justify-content-start mb-3 mb-md-0">
                <h5 class="mb-0 fw-bold">{{ $order->origin }}</h5>
                <div class="d-flex align-items-center mx-4">
                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                    <div class="bg-primary mx-3" style="width: 100px; height: 2px;"></div>
                    <i class="ti ti-clock text-primary fs-5"></i>
                    <h6 class="mb-0 mx-2 text-primary fw-semibold">
                        {{ \Carbon\Carbon::parse($order->deliveryDate)->diffInDays(\Carbon\Carbon::parse($order->arrivalDate)) }} Hari
                    </h6>
                    <div class="bg-primary mx-3" style="width: 100px; height: 2px;"></div>
                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                </div>
                <h5 class="mb-0 fw-bold">{{ $order->destination }}</h5>
            </div>
            <div class="col-md-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-primary d-flex align-items-center" style="border-radius: 20px; padding: 8px 16px;">
                    <i class="ti {{ $order->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-2"></i>
                    {{ ucfirst($order->shipmentMode) }}
                </button>
                <button type="button" class="btn btn-outline-secondary d-flex align-items-center" style="border-radius: 20px; padding: 8px 16px;">
                    <i class="ti ti-box me-2"></i>
                    {{ $order->shipmentType }}
                </button>
            </div>
        </div>

        <!-- Dates Info -->
        <div class="row align-items-center mt-4">
            <div class="col-md-8 d-flex align-items-center justify-content-start gap-5">
                <div>
                    <h6 class="mb-1 text-muted">Tanggal Muat:</h6>
                    <h5 class="mb-0 text-primary fw-semibold">
                        {{ \Carbon\Carbon::parse($order->pickupDate)->translatedFormat('l, d F Y') }}
                    </h5>
                </div>
                <div>
                    <h6 class="mb-1 text-muted">Tanggal Pengiriman:</h6>
                    <h5 class="mb-0 text-primary fw-semibold">
                        {{ \Carbon\Carbon::parse($order->deliveryDate)->translatedFormat('l, d F Y') }}
                    </h5>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('order-management.showOffer', $order->id) }}" class="btn btn-primary d-flex align-items-center" style="border-radius: 20px; padding: 10px 20px;">
                    <span class="me-2">Lihat Detail</span>
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
            @endforeach
        </div>
    </div>

@endsection
