@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Payment History')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                {{-- <h2 class="mb-0">Payment History</h2> --}}
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        <i class="feather icon-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment History</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-12">
                     <h3 class="m-b-10">Payment History</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No</th>
                                            <th style="width: 100px;">Asal</th>
                                            <th style="width: 100px;">Tujuan</th>
                                            <th style="width: 80px;">Tipe</th>
                                            <th style="width: 80px;">Moda</th>
                                            <th style="width: 120px;">Jenis Barang</th>
                                            <th style="width: 80px;">Berat</th>
                                            <th style="width: 80px;">Volume</th>
                                            <th style="width: 120px;">Tanggal Pengiriman</th>
                                            <th class="text-end" style="width: 120px;">Total Harga</th>
                                            <th class="text-center" style="width: 100px;">Status</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($userOrders as $index => $userOrder)
                                            @php
                                                $no = ($userOrders->currentPage() - 1) * $userOrders->perPage() + $index + 1;
                                            @endphp
                                            <tr>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark">{{ $no }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $userOrder->order->origin }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $userOrder->order->destination }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $userOrder->order->shipmentType }}</span>
                                                </td>
                                                <td>
                                                    {{ $userOrder->order->shipmentMode }}
                                                </td>
                                                <td>
                                                    <strong>{{ $userOrder->commodities }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning text-dark">{{ $userOrder->weight }} kg</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $userOrder->volume }} CBM</span>
                                                </td>
                                                <td>
                                                    <i class="feather icon-calendar text-muted me-1"></i>
                                                    {{ \Carbon\Carbon::parse($userOrder->order->shippingDate)->format('d M Y') }}
                                                </td>
                                                <td class="text-end">
                                                    <strong class="text-primary fs-6">
                                                        Rp {{ number_format($userOrder->totalPrice, 0, ',', '.') }}
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    @if ($userOrder['paymentStatus'] == 'Belum Lunas')
                                                        <span class="badge bg-danger">
                                                            <i class="feather icon-clock me-1"></i>
                                                            Belum Lunas
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="feather icon-check-circle me-1"></i>
                                                            Lunas
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($userOrder['paymentStatus'] == 'Belum Lunas')
                                                        <a href="/opencontainer/payment/{{ $userOrder->payment_token }}"
                                                           class="btn btn-warning btn-sm"
                                                           data-bs-toggle="tooltip"
                                                           title="Bayar Sekarang">
                                                            <i class="feather icon-credit-card me-1"></i>
                                                            Bayar
                                                        </a>
                                                    @else
                                                        <a href="#"
                                                           class="btn btn-primary btn-sm"
                                                           data-bs-toggle="tooltip"
                                                           title="Download Invoice">
                                                            <i class="feather icon-download me-1"></i>
                                                            Invoice
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <i class="feather icon-credit-card" style="font-size: 48px; color: #ccc;"></i>
                                                        <h5 class="mt-3 text-muted">Belum ada riwayat pembayaran</h5>
                                                        <p class="text-muted">Transaksi pembayaran Anda akan muncul di sini</p>
                                                        <a href="/dashboard" class="btn btn-primary mt-2">
                                                            <i class="feather icon-plus me-1"></i>
                                                            Buat Pesanan Baru
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @if($userOrders->hasPages())
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="showing-info">
                                        <small class="text-muted">
                                            Menampilkan {{ $userOrders->firstItem() }} - {{ $userOrders->lastItem() }}
                                            dari {{ $userOrders->total() }} transaksi
                                        </small>
                                    </div>
                                    <div class="pagination-wrapper">
                                        {{ $userOrders->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th {
            font-weight: 600;
            font-size: 0.875rem;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
        }

        .table td {
            font-size: 0.875rem;
            padding: 1rem 0.75rem;
        }

        .route-info, .shipment-info, .cargo-info {
            min-width: fit-content;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .price-info strong {
            font-size: 1rem;
        }

        .empty-state {
            padding: 3rem 1rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .showing-info {
            flex-grow: 1;
        }

        .pagination-wrapper .pagination {
            margin-bottom: 0;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .table-responsive {
                border: none;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .showing-info {
                text-align: center;
            }
        }
    </style>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
