@extends('layouts.app')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <h4 class="mb-4">Tambah Truk</h4>

            <form action="{{ route('trucks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input type="text" name="type" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" name="color" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Year Built</label>
                    <input type="number" name="yearBuilt" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Plate Number</label>
                    <input type="text" name="plateNumber" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Driver Name</label>
                    <input type="text" name="driverName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Driver Contact</label>
                    <input type="text" name="driverContact" class="form-control" required>
                </div>
                {{--
            <div class="mb-3">
                <label class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div> --}}

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
