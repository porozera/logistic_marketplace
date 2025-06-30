@extends('layouts.app')

@section('title', 'Kategori Barang')

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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Kategori Barang</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create HS Code  </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data HS Code</h5>
        </div>
        <div class="card-body">
          <form action="/admin/category-add" method="post">
            @csrf
            <div>
                <div class="form-group">
                    <label for="code" class="form-label">Kode</label>
                    <input type="text" class="form-control" name="code" id="code" placeholder="Masukkan kode barang" value="{{ old('code') }}" required>
                    <small class="form-text text-muted">Contoh : CG001</small>
                    @error('code')
                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="name" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama barang" value="{{ old('name') }}" required>
                    <small class="form-text text-muted">Contoh : Peralatan Kantor</small>
                    @error('name')
                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label class="form-label" for="type">Tipe</label>
                    <select class="form-select" id="type" name="type" required>
                        <option selected>-- Pilih Tipe --</option>
                        <option>General Cargo</option>
                        <option>Special Cargo</option>
                        <option>Irregularity Cargo</option>
                        <option>Dangerous Cargo</option>
                    </select>
                    @error('type')
                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="description" required>Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi" value="{{ old('description') }}"></textarea>
                @error('description')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="card-footer text-end">
              <a href="/admin/category" class="btn btn-danger me-2">Cancel</a>
                <button class="btn btn-primary me-2">Submit</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
@endsection
