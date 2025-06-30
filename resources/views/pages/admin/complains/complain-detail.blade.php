@extends('layouts.app')

@section('title', 'Detail Komplain')

@section('content')
<style>
    /* Tambahan font-size untuk area yang belum ter-cover Bootstrap */
    .complain-text, .complain-date, .response-text, .response-date {
        font-size: 18px;
    }
</style>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb fs-5">
                            <li class="breadcrumb-item"><a href="{{ route('admin.complain.index') }}">Manajemen Komplain</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0 fs-3">Detail Komplain #{{ $complain->id }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10 col-xxl-10"><!-- lebar card lebih besar -->

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="fs-5">Komplain dari: {{ $complain->username }}</h5>
                        @php
                            $badgeClass = $complain->status === 'Solved' ? 'btn-success' : 'btn-warning';
                            $badgeIcon = $complain->status === 'Solved' ? 'ti-check' : 'ti-clock';
                        @endphp
                        <button type="button" class="btn {{ $badgeClass }} d-inline-flex rounded-pill fs-6">
                            <i class="ti {{ $badgeIcon }} me-1"></i> {{ $complain->status }}
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 complain-text">{{ $complain->description }}</p>
                    </div>
                    <div class="card-footer">
                        <p class="text-muted mb-0 complain-date">Dikirim pada: {{ $complain->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                @foreach($complain->responses as $resp)
                @php
                    $is_admin = $resp->user->role === 'admin';
                @endphp
                <div class="card card-hover mb-3 {{ $is_admin ? 'border-3' : '' }}">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold mb-0 fs-5">
                                {{ $resp->user->name }}
                                @if($is_admin)
                                    <span class="badge bg-light-primary text-primary rounded-pill ms-2">Admin</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <p class="mb-0 response-text">{{ $resp->response }}</p>
                    </div>
                    <div class="card-footer py-2">
                        <div class="row">
                            <div class="d-flex">
                                <p class="me-3 mt-2 text-muted small response-date">{{ $resp->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- Form Balasan Komplain --}}
                <div class="card mt-5 border border-primary shadow-lg bg-light">
                    <div class="card-body">
                        <h5 class="mb-3 text-primary d-flex align-items-center fs-5">
                            <i class="ti ti-mail me-2"></i> Kirim Balasan Anda
                        </h5>
                        <form action="{{ route('admin.complain.storeResponse', $complain->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="response" class="form-control fs-5" rows="4" placeholder="Tulis balasan Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 fs-6">
                                <i class="ti ti-send me-1"></i> Kirim Balasan
                            </button>
                        </form>
                    </div>
                </div>

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
                showConfirmButton: true,
                confirmButtonText: "OK",
            });
        @endif
    });
</script>
@endsection
