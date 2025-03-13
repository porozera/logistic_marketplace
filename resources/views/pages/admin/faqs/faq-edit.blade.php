@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="container" style="padding-left: 250px; padding-top:80px;">

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Frequently Asked Questions (FAQs)</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Frequently Asked Questions</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

    <div class="card">
        <div class="card-header">
          <h5>Form Edit Data Frequently Asked Questions</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('faq/'.$faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <div class="form-group">
                        <label class="form-label" for="type">Tipe</label>
                        <select class="form-select" id="type" name="type">
                            <option value="General" {{ old('type', $faq->type) == 'General' ? 'selected' : '' }}>General</option>
                            <option value="Peralatan" {{ old('type', $faq->type) == 'Peralatan' ? 'selected' : '' }}>Peralatan</option>
                            <option value="Harga & Pembayaran" {{ old('type', $faq->type) == 'Harga & Pembayaran' ? 'selected' : '' }}>Harga & Pembayaran</option>
                            <option value="Pengiriman" {{ old('type', $faq->type) == 'Pengiriman' ? 'selected' : '' }}>Pengiriman</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="header" class="form-label">Pertanyaan</label>
                        <input type="text" name="header" id="header" class="form-control" value="{{ $faq->header }}" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $faq->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('faq') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection