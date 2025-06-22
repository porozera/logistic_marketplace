@extends('layouts.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <h4 class="mb-4">Edit Truk</h4>

        <form action="{{ route('trucks.update', $truck->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control" value="{{ $truck->brand }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" value="{{ $truck->type }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <input type="text" name="color" class="form-control" value="{{ $truck->color }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Year Built</label>
                <input type="number" name="yearBuilt" class="form-control" value="{{ $truck->yearBuilt }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Plate Number</label>
                <input type="text" name="plateNumber" class="form-control" value="{{ $truck->plateNumber }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Picture</label>
                <input type="file" name="picture" class="form-control">
                <label class="form-label mt-2">Preview : </label>
                @if ($truck->picture)
                    <img src="{{ asset('storage/' . $truck->picture) }}" alt="Truck Picture" class="img-thumbnail"
                        style="width: 100px; height: 100px;">
                @else
                    <p class="text-muted">Tidak ada gambar</p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Driver Name</label>
                <input type="text" name="driverName" class="form-control" value="{{ $truck->driverName }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Driver Contact</label>
                <input type="text" name="driverContact" class="form-control" value="{{ $truck->driverContact }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control" value="{{ $truck->user_id }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
