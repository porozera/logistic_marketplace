@extends('layouts.app')

@section('title', 'Approval')

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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/report-customer') }}">Approval LSP</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Data</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0 mt-3">Detail Informasi Perusahaan</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach([
                                'companyName' => 'Nama Perusahaan',
                                'permitNumber' => 'Nomor Izin Penyelenggaraan',
                                'email' => 'Email',
                                'telpNumber' => 'Nomor Telepon',
                            ] as $field => $label)
                                <div class="form-group">
                                    <label class="form-label">{{ $label }}</label>
                                    <input type="text" class="form-control" value="{{ $approval->$field }}" disabled>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3" disabled>{{ $approval->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" value="{{ $approval->status }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between mt-3">
                        <!-- Kiri -->
                        <a href="{{ route('admin.approval-lsp') }}" class="btn btn-secondary">Kembali</a>

                        <!-- Kanan -->
                        @if ($approval->status === 'Requested')
                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('confirmation.sendEmail') }}" method="post" class="m-0">
                                @csrf
                                <input type="hidden" name="email" value="{{ $approval->email }}">
                                <input type="hidden" name="approval_id" value="{{ $approval->id }}">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <p style="margin: 0;">Minta Bukti Legalitas Perusahaan</p>
                                    <button type="submit" class="btn btn-primary" style="min-width: 100px;">Kirim Email</button>
                                </div>
                            </form>
                        </div>
                        @elseif ($approval->status === 'On Confirmation')
                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('approval.sendEmail') }}" method="post" class="m-0">
                                @csrf
                                <input type="hidden" name="email" value="{{ $approval->email }}">
                                <input type="hidden" name="approval_id" value="{{ $approval->id }}">
                                <button type="submit" class="btn btn-primary w-100" style="min-width: 100px;">Approve</button>
                            </form>
                        
                            <form action="{{ route('rejected.sendEmail') }}" method="post" class="m-0">
                                @csrf
                                <input type="hidden" name="email" value="{{ $approval->email }}">
                                <input type="hidden" name="approval_id" value="{{ $approval->id }}">
                                <button type="submit" class="btn btn-danger w-100" style="min-width: 100px;">Reject</button>
                            </form>
                        </div>
                        @endif
                    </div>
                
            </div>
        </div>
    </div> 
</div> 
@endsection
