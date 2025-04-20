@extends('layouts.app')

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
                                <li class="breadcrumb-item" aria-current="page">Kelola Truck</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-4">Kelola Truck</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xl-15 ">
                    <div class="card tbl-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <h3 class="mb-3">Daftar Truck</h3>
                                <a href="{{ route('trucks.create') }}" class="btn btn-primary mb-3">Tambah Truk</a>

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Brand</th>
                                            <th>Type</th>
                                            <th>Color</th>
                                            <th>Year Built</th>
                                            <th>Plate Number</th>
                                            <th>Driver Name</th>
                                            <th>Driver Contact</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trucks as $truck)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $truck->brand }}</td>
                                                <td>{{ $truck->type }}</td>
                                                <td>{{ $truck->color ?? '-' }}</td>
                                                <td>{{ $truck->yearBuilt }}</td>
                                                <td>{{ $truck->plateNumber }}</td>
                                                <td>{{ $truck->driverName }}</td>
                                                <td>{{ $truck->driverContact }}</td>
                                                <td style="text-align: center">
                                                    <a href="{{ route('trucks.edit', $truck->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
