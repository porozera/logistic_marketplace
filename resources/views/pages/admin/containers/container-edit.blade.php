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
                <form action="{{ url('/admin/container/'.$container->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Nama Kontainer</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $container->name }}" required>
                                @error('name')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="code" class="form-label">Kode Kontainer</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ $container->code }}" required>
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
                                <input type="number" name="weight" id="weight" class="form-control" value="{{ $container->weight }}" required>
                                @error('weight')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="volume" class="form-label">Volume (CBM)</label>
                                <input type="number" name="volume" id="volume" class="form-control" value="{{ $container->volume }}" required>
                                @error('volume')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">  <!-- Tambahkan row agar sejajar -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="5" required>{{ $container->description }}</textarea>
                                @error('description')
                                <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ url('/admin/container') }}" class="btn btn-danger me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
