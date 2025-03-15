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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Kota</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Kota</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data Kota</h5>
        </div>
        <div class="card-body">

          <form action="city-add" method="post">
            @csrf
            <div class="form-group">
                <label for="id_province" class="form-label">Provinsi</label>
                <select class="form-control" name="id_province" id="id_province" required>
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div class="form-group">
                    <label for="name" class="form-label">Kota</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama kota" value="{{ old('name') }}" required>
                    {{-- <small class="form-text text-muted">Please enter your Password</small> --}}
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="postalCode" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="Masukkan kode pos" value="{{ old('postalCode') }}" required>
                    {{-- <small class="form-text text-muted">Contoh : SRV001</small> --}}
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <a href="/city" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
</div>
@endsection
