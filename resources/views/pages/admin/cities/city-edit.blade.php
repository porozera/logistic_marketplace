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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Kota</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Data Kota</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

    <div class="card">
        <div class="card-header">
          <h5>Form Edit Data Kota</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/admin/city/'.$city->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div>
                    <div class="form-group">
                        <label for="id_province" class="form-label">Provinsi</label>
                        <select name="id_province" id="id_province" class="form-control" required>
                            <option value="" disabled>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ $city->id_province == $province->id ? 'selected' : '' }}>
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="name" class="form-label">Kota</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $city->name }}" required>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="postalCode" class="form-label">Kode</label>
                        <input type="text" name="postalCode" id="postalCode" class="form-control" value="{{ $city->postalCode }}" required>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('/admin/city') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
