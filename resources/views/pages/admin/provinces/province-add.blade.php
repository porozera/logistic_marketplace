@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container" style="padding-left: 250px; padding-top:80px;">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Provisi</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Data Provinsi</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data Provinsi</h5>
        </div>
        <div class="card-body">

          <form action="/admin/province-add" method="post">
            @csrf
            <div>
                <div class="form-group">
                    <label for="name" class="form-label">Nama Provinsi</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama provinsi" value="{{ old('name') }}" required>
                    <small class="form-text text-muted">Contoh : Jawa Barat</small>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="postalCode" class="form-label">Kode Wilayah Administrasi</label>
                    <input type="number" class="form-control" name="postalCode" id="postalCode" placeholder="Masukkan kode wilayah administrasi" value="{{ old('postalCode') }}" required>
                    <small class="form-text text-muted">Contoh : 32</small>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <a href="/admin/province" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
</div>
@endsection
