@extends('layouts.app')

@section('title', 'Layanan')

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
                <li class="breadcrumb-item" aria-current="page">Edit Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Jenis Layanan</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

    <div class="card">
        <div class="card-header">
          <h5>Form Edit Data Jenis Layanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/service/'.$service->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <div class="form-group">
                        <label for="code" class="form-label">Kode</label>
                        <input type="text" name="code" id="code" class="form-control" value="{{ $service->code }}" required>
                        @error('code')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="serviceName" class="form-label">Nama Layanan</label>
                        <input type="text" name="serviceName" id="serviceName" class="form-control" value="{{ $service->serviceName }}" required>
                        @error('serviceName')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $service->price }}" required>
                        @error('price')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" name="icon" id="icon" class="form-control" value="{{ $service->icon }}" required>
                        @error('icon')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ $service->description }}</textarea>
                        @error('description')
                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-end">
                  <a href="{{ url('admin/service') }}" class="btn btn-danger me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
