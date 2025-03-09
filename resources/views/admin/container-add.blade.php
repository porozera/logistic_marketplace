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

          <form action="kontainer-add" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="name" class="form-label">Nama Kontainer:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama kontainer" value="{{ old('code') }}">
                  <small class="form-text text-muted">Contoh : 20' Standard</small>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="code" class="form-label">Kode:</label>
                  <input type="text" class="form-control" name="code" id="code" placeholder="Masukkan kode kontainer" value="{{ old('name') }}">
                  <small class="form-text text-muted">Contoh : CT-20STD</small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="weight" class="form-label">Berat Maksimal (kg)</label>
                  <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan berat maksimal dalam satuan kilogram" value="{{ old('weight') }}">
                  {{-- <small class="form-text text-muted">Please enter your Password</small> --}}
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="volume" class="form-label">Volume (CBM):</label>
                    <input type="number" class="form-control" name="volume" id="volume" placeholder="Masukkan volume" value="{{ old('volume') }}">
                  {{-- <small class="form-text text-muted">Please enter your Profile URL</small> --}}
                </div>
              </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi kontainer" value="{{ old('desription') }}"></textarea>
            </div>

            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-secondary">Cancel</button>
            </div>

          </form>
        </div>
      </div>
    
</div>
@endsection
