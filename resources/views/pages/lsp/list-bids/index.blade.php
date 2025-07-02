@extends('layouts.app')
@section('title', 'List Bids')
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
                            {{-- <div class="page-header-title">
                                <h2 class="mb-0">List Bidding</h2>
                            </div> --}}
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Bids List</li>
                                {{-- <li class="breadcrumb-item" aria-current="page">Bids List</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Daftar Penawaran</h5>
                            <div class="card-header-right">
                                <span class="badge bg-primary">{{ $bids->count() }} Total Penawaran</span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($bids->isEmpty())
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="ph-duotone ph-clipboard-text f-40 text-muted"></i>
                                    </div>
                                    <h5 class="text-muted">Belum Ada Penawaran</h5>
                                    <p class="text-muted mb-0">Belum ada data penawaran yang tersedia saat ini.</p>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover" id="pc-dt-simple">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center" style="width: 50px;">No</th>
                                                <th>No Offer</th>
                                                <th>Rute</th>
                                                <th>Jadwal</th>
                                                <th>Detail Pengiriman</th>
                                                <th>Jenis Barang</th>
                                                <th class="text-end">Harga</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($bids as $bid)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td>
                                                        <strong class="text-primary">{{ $bid->noOffer }}</strong>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div class="text-muted small">Dari:</div>
                                                                <strong>{{ $bid->origin }}</strong>
                                                                <div class="text-muted small mt-1">Ke:</div>
                                                                <strong>{{ $bid->destination }}</strong>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-muted small">Muat:</div>
                                                        <div class="fw-medium">
                                                            {{ \Carbon\Carbon::parse($bid->loadingDate)->translatedFormat('d M Y') }}
                                                        </div>
                                                        <div class="text-muted small mt-1">Kirim:</div>
                                                        <div class="fw-medium">
                                                            {{ \Carbon\Carbon::parse($bid->shippingDate)->translatedFormat('d M Y') }}
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <div class="mb-1">
                                                            <span class="badge bg-light-secondary">{{ $bid->shipmentType }}</span>
                                                        </div>
                                                        <div>
                                                            <span class="badge bg-light-info">{{ ucfirst($bid->shipmentMode) }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark fw-medium">{{ $bid->commodities }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <strong class="text-success">
                                                            Rp {{ number_format($bid->price, 0, ',', '.') }}
                                                        </strong>
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $statusClass = match(strtolower($bid->status)) {
                                                                'pending' => 'bg-warning',
                                                                'approved' => 'bg-success',
                                                                'rejected' => 'bg-danger',
                                                                'completed' => 'bg-primary',
                                                                default => 'bg-secondary'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $statusClass }}">
                                                            {{ ucfirst($bid->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        .table th {
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.75rem;
        }

        .text-muted.small {
            font-size: 0.75rem;
        }

        .fw-medium {
            font-weight: 500;
        }

        .table-responsive {
            border-radius: 0.375rem;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }

            .table th, .table td {
                padding: 0.5rem 0.25rem;
            }
        }
    </style>
    @endpush

@endsection
