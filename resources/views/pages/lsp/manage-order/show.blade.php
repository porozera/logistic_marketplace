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
                        <div class="page-header-title mt-3">
                            <h4 class="mb-0">Detail Order - {{ $order->noOffer }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Detail Card -->
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

                    <!-- Dates and Status Info -->
                    <div class="row align-items-center mt-4">
                        <div class="col-md-4">
                            <h6 class="mb-1 text-muted">Tanggal Muat:</h6>
                            <h5 class="mb-0 text-primary fw-semibold">
                                {{ \Carbon\Carbon::parse($order->pickupDate)->translatedFormat('l, d F Y') }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-1 text-muted">Tanggal Pengiriman:</h6>
                            <h5 class="mb-0 text-primary fw-semibold">
                                {{ \Carbon\Carbon::parse($order->deliveryDate)->translatedFormat('l, d F Y') }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-1 text-muted">Status Pengiriman:</h6>
                            <form action="{{ route('order-management.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control form-control-sm" style="border-radius: 8px; min-width: 140px;" required>
                                    <option value="Loading Item" {{ $order->status == 'Loading Item' ? 'selected' : '' }}>Loading Item</option>
                                    <option value="On The Way" {{ $order->status == 'On The Way' ? 'selected' : '' }}>On The Way</option>
                                    <option value="Finished" {{ $order->status == 'Finished' ? 'selected' : '' }}>Finished</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 8px; white-space: nowrap;">
                                    <i class="ti ti-check me-1"></i>
                                    Update
                                </button>
                            </form>
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
                                        <!-- Header Row -->
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">ID Pemesanan:</small><br>
                                                    <span class="fw-bold">{{ $uo->id }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">User ID:</small><br>
                                                    <span>{{ $uo->user_id }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">Order ID:</small><br>
                                                    <span>{{ $uo->order_id }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">Nama Penerima:</small><br>
                                                    <span class="fw-bold">{{ $uo->receiverName }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">No. Telepon:</small><br>
                                                    <span>{{ $uo->receiverTelpNumber }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">No. Invoice:</small><br>
                                                    <span>{{ $uo->invoiceNumber }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">Total Harga:</small><br>
                                                    <span class="text-success fw-bold fs-5">Rp {{ number_format($uo->totalPrice, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="mb-2">
                                                    <small class="text-muted fw-bold">Status Pembayaran:</small><br>
                                                    <span class="badge {{ $uo->paymentStatus == 'Lunas' ? 'bg-success' : ($uo->paymentStatus == 'pending' ? 'bg-warning' : 'bg-danger') }} px-3 py-2">
                                                        {{ ucfirst($uo->paymentStatus) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-3">

                                        <!-- Address Row -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <small class="text-muted fw-bold">Alamat Asal:</small><br>
                                                <span class="text-dark">{{ $uo->originAddress ?: '-' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted fw-bold">Alamat Tujuan:</small><br>
                                                <span class="text-dark">{{ $uo->destinationAddress ?: '-' }}</span>
                                            </div>
                                        </div>

                                        <!-- Description Row -->
                                        @if($uo->description)
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <small class="text-muted fw-bold">Deskripsi:</small><br>
                                                <span class="text-dark">{{ $uo->description }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        <hr class="my-3">

                                        <!-- Date Row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <small class="text-muted fw-bold">Tanggal Pemesanan:</small><br>
                                                <span class="text-primary fw-bold">{{ \Carbon\Carbon::parse($uo->created_at)->translatedFormat('d F Y H:i') }}</span>
                                            </div>
                                            @if($uo->RTL_start_date)
                                            <div class="col-md-4">
                                                <small class="text-muted fw-bold">RTL Start Date:</small><br>
                                                <span class="text-info fw-bold">{{ \Carbon\Carbon::parse($uo->RTL_start_date)->translatedFormat('d F Y') }}</span>
                                            </div>
                                            @endif
                                            @if($uo->RTL_end_date)
                                            <div class="col-md-4">
                                                <small class="text-muted fw-bold">RTL End Date:</small><br>
                                                <span class="text-info fw-bold">{{ \Carbon\Carbon::parse($uo->RTL_end_date)->translatedFormat('d F Y') }}</span>
                                            </div>
                                            @endif
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
