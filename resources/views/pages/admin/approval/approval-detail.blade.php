@extends('layouts.app')

@section('title', 'Detail Pengguna')

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
                            <li class="breadcrumb-item"><a href="{{ url('/admin/report-customer') }}">Pengguna</a></li>
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
                <form method="POST" action="/send-approve-email">
                    @csrf

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
                        @if ($approval->status === 'Butuh di Approve')
                        <div>
                            <form action="{{ route('approval.sendEmail') }}" method="post">
                                @csrf
                                <input type="hidden" class="form-control" name="email" value="{{ $approval->email }}">
                                <input type="hidden" name="approval_id" value="{{ $approval->id }}">
                                    {{-- <textarea name="pesan" id="" cols="30" rows="10"></textarea> --}}
                                    <button type="submit" class="btn btn-primary">Approve</button>
                            </form>

                            <button type="submit" class="btn btn-danger">Reject</button>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div> 
@endsection
