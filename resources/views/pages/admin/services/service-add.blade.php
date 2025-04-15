@extends('layouts.app')

@section('title', 'Dashboard')

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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Layanan</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Jenis Layanan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data Jenis Layanan</h5>
        </div>
        <div class="card-body">

          <form action="{{ route('admin.service.store') }}" method="post">
            @csrf
            <div>
                <div class="form-group">
                    <label for="code" class="form-label">Kode</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="Masukkan kode layanan" value="{{ old('code') }}" required>
                    <small class="form-text text-muted">Contoh : SRV001</small>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="serviceName" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control" name="serviceName" id="serviceName" placeholder="Masukkan nama layanan" value="{{ old('serviceName') }}" required>
                    <small class="form-text text-muted">Contoh : Inspeksi Sebelum Pengiriman</small>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Masukkan harga layanan" value="{{ old('price') }}" required>
                    {{-- <small class="form-text text-muted">Please enter your Password</small> --}}
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon" id="icon" placeholder="Masukkan class icon" value="{{ old('icon') }}" required>
                    {{-- <small class="form-text text-muted">Please enter your Password</small> --}}
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi layanan" value="{{ old('description') }}" required></textarea>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <a href="/admin/service" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    </div>
</div>
@endsection
