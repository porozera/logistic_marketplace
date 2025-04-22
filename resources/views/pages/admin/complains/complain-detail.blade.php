@extends('layouts.app')

@section('title', 'Komplain')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Detail Komplain</li>
                </ul>
                </div>
                <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Detail Komplain</h2>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
            <h5>Detail Informasi Komplain</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" value="{{ $complain->email }}" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" value="{{ $complain->username }}" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">Deskripsi Keluhan</label>
                  <textarea class="form-control" rows="5" readonly>{{ $complain->description }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Status</label>
                  <input type="text" class="form-control" value="{{ $complain->status }}" readonly>
                </div>
              </div>

              <form action="/send-answer-email" method="post">
                @csrf
                <input type="hidden" name="username" value="{{ $complain->username }}">
                <input type="hidden" name="complain_id" value="{{ $complain->id }}">

                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Form Kirim Email Tanggapan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Kepada (Email)</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $complain->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan Tanggapan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5" placeholder="Tulis tanggapan Anda..."></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/admin/complain') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Kirim Email</button>
                        </div>
                    </div>
                </div>
            </form>

            </div>
        </div>

    </div>
</div>
@endsection