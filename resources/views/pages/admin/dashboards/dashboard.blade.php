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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Kategori Barang</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Kategori Barang</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

    {{-- <div class="card">
        <div class="card-header">
          <h5>Form Edit Data Kategori Barang</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('category/'.$category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <div class="form-group">
                        <label for="code" class="form-label">Kode</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ $category->code }}" required>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Barang</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label class="form-label" for="type">Tipe</label>
                        <select class="form-select" id="type" name="type">
                            <option value="General Cargo" {{ old('type', $category->type) == 'General Cargo' ? 'selected' : '' }}>General Cargo</option>
                            <option value="Special Cargo" {{ old('type', $category->type) == 'Special Cargo' ? 'selected' : '' }}>Special Cargo</option>
                            <option value="Irregularity Cargo" {{ old('type', $category->type) == 'Irregularity Cargo' ? 'selected' : '' }}>Irregularity Cargo</option>
                            <option value="Dangerous Cargo" {{ old('type', $category->type) == 'Dangerous Cargo' ? 'selected' : '' }}>Dangerous Cargo</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $category->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('category') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div> --}}

</div>
@endsection