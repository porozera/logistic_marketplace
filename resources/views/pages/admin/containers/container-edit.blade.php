@extends('layouts.app')

@section('title', 'Edit Kontainer')

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
                <li class="breadcrumb-item" aria-current="page">Edit Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Edit Jenis Kontainer</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

    <div class="card">
        <div class="card-header">
          <h5>Form Edit Data Jenis Kontainer</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('container/'.$container->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="code" class="form-label">Kode Kontainer</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ $container->code }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Kontainer</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $container->name }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="weight" class="form-label">Berat Maksimal (kg)</label>
                            <input type="number" name="weight" id="weight" class="form-control" value="{{ $container->weight }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="volume" class="form-label">Volume (CBM)</label>
                            <input type="number" name="volume" id="volume" class="form-control" value="{{ $container->volume }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">  <!-- Tambahkan row agar sejajar -->
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $container->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('container') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
