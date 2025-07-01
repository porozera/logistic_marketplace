@extends('layouts.app') 

@section('title', 'Detail Komplain')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.complain.index') }}">Manajemen Komplain</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail Komplain #{{ $complain->id }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-8">

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Komplain dari: {{ $complain->username }}</h5>
                        @php
                            $badgeClass = $complain->status === 'Solved' ? 'btn-success' : 'btn-warning';
                            $badgeIcon = $complain->status === 'Solved' ? 'ti-check' : 'ti-clock';
                        @endphp
                        <button type="button" class="btn {{ $badgeClass }} d-inline-flex rounded-pill">
                            <i class="ti {{ $badgeIcon }} me-1"></i> {{ $complain->status }}
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $complain->description }}</p>
                    </div>
                    <div class="card-footer">
                        <p class="text-muted mb-0">Dikirim pada: {{ $complain->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                @foreach($complain->responses as $resp)
                @php
                    // Asumsi role 'admin' ada di tabel user, jika tidak sesuaikan logikanya
                    $is_admin = $resp->user->role === 'admin'; 
                @endphp
                <div class="card card-hover mb-3 {{ $is_admin ? 'border-start border-primary border-3' : '' }}">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="fw-bold mb-0">
                                {{ $resp->user->name }}
                                @if($is_admin)
                                    <span class="badge bg-light-primary text-primary rounded-pill ms-2">Admin</span>
                                @else
                                    <span class="badge bg-light-success text-success rounded-pill ms-2">{{$resp->user->firstName}}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <p class="mb-0">{{ $resp->response }}</p>
                    </div>
                    <div class="card-footer py-2">
                        <div class="row">
                            <div class="d-flex">
                                <p class="me-3 mt-2 text-muted small">{{ $resp->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Kirim Balasan Anda</h5>
                        <form action="{{ route('response.customer.store', $complain->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="response" class="form-control" rows="4" placeholder="Tulis balasan Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Kirim Balasan</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Apakah masalah ini sudah terselesaikan?</h5>
                        <form action="{{ route('response.update-status', $complain->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex gap-3">
                                <button type="submit" name="solved" value="yes" class="btn btn-success d-flex align-items-center">
                                    <i class="ti ti-check me-2"></i> Iya
                                </button>
                                <button type="" name="solved" value="no" class="btn btn-danger d-flex align-items-center">
                                    <i class="ti ti-x me-2"></i> Tidak
                                </button>
                            </div>
                            <br>
                            <small>*Jika masalah sudah selesai bisa menekan tombol "Iya" diatas.</small>
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