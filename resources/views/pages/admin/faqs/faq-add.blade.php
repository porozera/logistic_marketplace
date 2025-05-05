@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container" style="padding-left: 250px; padding-top:80px;">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">FAQs Data</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Frequently Asked Questions (FAQs)</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Data Frequently Asked Questions</h5>
        </div>
        <div class="card-body">

          <form action="/admin/faq-add" method="post">
            @csrf
            <div>
                <div class="form-group">
                    <label class="form-label" for="type">Tipe</label>
                    <select class="form-select" id="type" name="type" required>
                        <option selected>Pilih Tipe</option>
                        <option>General</option>
                        <option>Peralatan</option>
                        <option>Harga & Pembayaran</option>
                        <option>Pengiriman</option>
                    </select>
                    @error('type')
                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="header" class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" name="header" id="header" placeholder="Masukkan pertanyaan" value="{{ old('header') }}" required>
                    @error('header')
                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                    @enderror
                    <small class="form-text text-muted">Contoh : SRV001</small>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Masukkan deskripsi" value="{{ old('description') }}" required></textarea>
                @error('description')
                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary me-2">Submit</button>
                <a href="/admin/faq" class="btn btn-secondary">Cancel</a>
            </div>

          </form>
        </div>
      </div>
</div>
@endsection
