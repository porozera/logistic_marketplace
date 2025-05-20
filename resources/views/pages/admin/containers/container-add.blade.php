@extends('layouts.app')

@section('title', 'Kontainer')

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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Kontainer</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Jenis Kontainer</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data Jenis Kontainer</h5>
        </div>
        <div class="card-body">

          <form action="/admin/container-add" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="name" class="form-label">Nama Kontainer:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama kontainer" value="{{ old('name') }}" required>
                  <small class="form-text text-muted">Contoh : 20' Standard</small>
                  @error('name')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="code" class="form-label">Kode:</label>
                  <input type="text" class="form-control" name="code" id="code" placeholder="Masukkan kode kontainer" value="{{ old('code') }}" required>
                  <small class="form-text text-muted">Contoh : CT-20STD</small>
                  @error('code')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="weight" class="form-label">Berat Maksimal (kg)</label>
                  <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan berat maksimal dalam satuan kilogram" value="{{ old('weight') }}" required>
                  @error('weight')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                  @enderror
                  {{-- <small class="form-text text-muted">Please enter your Password</small> --}}
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="volume" class="form-label">Volume (CBM):</label>
                  <input type="number" class="form-control" name="volume" id="volume" placeholder="Masukkan volume" value="{{ old('volume') }}" required>
                  @error('volume')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                  @enderror
                  {{-- <small class="form-text text-muted">Please enter your Profile URL</small> --}}
                </div>
              </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi kontainer" value="{{ old('description') }}" required></textarea>
                @error('description')
                  <p class="text-danger text-xs pt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <a href="/admin/container" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
    
  </div>
</div>
@endsection
