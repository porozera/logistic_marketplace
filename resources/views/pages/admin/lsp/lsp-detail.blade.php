@extends('layouts.app')

@section('title', 'Detail LSP')

@section('content')
<div class="pc-container">
    <div class="pc-content">
    <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/report-lsp') }}">LSP</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Data</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Detail Data LSP</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
                <h5>Informasi LSP</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-lg-6">
                        @foreach ([
                            'username' => 'Username',
                            'firstName' => 'Nama Depan',
                            'lastName' => 'Nama Belakang',
                            'companyName' => 'Nama Perusahaan',
                            'email' => 'Email',
                            'address' => 'Alamat'
                        ] as $field => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                @if($field === 'address')
                                    <textarea class="form-control" rows="3" disabled>{{ $lsp->$field }}</textarea>
                                @else
                                    <input type="text" class="form-control" value="{{ $lsp->$field }}" disabled>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Kanan -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label">Nomor Izin Penyelenggaraan</label>
                            <input type="text" class="form-control" value="{{ $lsp->permitNumber }}" disabled>
                        </div>

                        @foreach ([
                            'accountName' => 'Nama Akun Bank',
                            'accountNumber' => 'Nomor Rekening',
                            'rating' => 'Rating',
                            'telpNumber' => 'No. Telepon',
                        ] as $field => $label)
                            <div class="form-group">
                                <label class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" value="{{ $lsp->$field }}" disabled>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3" disabled>{{ $lsp->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end mt-3">
                    <a href="{{ route('admin.lsp.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
