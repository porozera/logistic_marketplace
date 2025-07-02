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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Daftar Truck</h3>
                            <a href="{{ route('trucks.create') }}" class="btn btn-primary">
                                <i class="feather icon-plus"></i> Tambah Truk
                            </a>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No</th>
                                            <th class="text-center" style="width: 120px;">Picture</th>
                                            <th style="width: 100px;">Brand</th>
                                            <th style="width: 120px;">Type</th>
                                            <th style="width: 80px;">Color</th>
                                            <th class="text-center" style="width: 100px;">Year Built</th>
                                            <th style="width: 120px;">Plate Number</th>
                                            <th style="width: 150px;">Coordinator Name</th>
                                            <th style="width: 140px;">Coordinator Contact</th>
                                            <th class="text-center" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trucks as $truck)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <span class="badge bg-light text-dark">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($truck->picture)
                                                        <img src="{{ asset('storage/' . $truck->picture) }}"
                                                            alt="Truck Picture"
                                                            class="img-thumbnail rounded"
                                                            style="width: 80px; height: 80px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                             style="width: 80px; height: 80px;">
                                                            <i class="feather icon-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-semibold">{{ $truck->brand }}</span>
                                                </td>
                                                <td class="align-middle">{{ $truck->type }}</td>
                                                <td class="align-middle">
                                                    @if($truck->color)
                                                        <span class="badge bg-secondary">{{ $truck->color }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    <span class="badge bg-info">{{ $truck->yearBuilt }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="fw-bold text-primary">{{ $truck->plateNumber }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <i class="feather icon-user me-2 text-muted"></i>
                                                        {{ $truck->driverName }}
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        <i class="feather icon-phone me-2 text-muted"></i>
                                                        <a href="tel:{{ $truck->driverContact }}" class="text-decoration-none">
                                                            {{ $truck->driverContact }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group" role="group" style="gap: 15px;">
                                                        <a href="{{ route('trucks.edit', $truck->id) }}"
                                                            data-bs-toggle="tooltip"
                                                            title="Edit Truck">
                                                            <i class="ti ti-edit-circle f-18"></i>
                                                        </a>
                                                        <form action="{{ route('trucks.destroy', $truck->id) }}"
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Yakin ingin menghapus truck {{ $truck->brand }} {{ $truck->type }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Hapus Truck">
                                                                <i class="ti ti-trash f-18"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="feather icon-truck" style="font-size: 48px; color: #ccc;"></i>
                                                        <h5 class="mt-3 text-muted">Belum ada data truck</h5>
                                                        <p class="text-muted">Klik tombol "Tambah Truk" untuk menambah data baru</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination jika menggunakan paginate -->
                            @if(method_exists($trucks, 'links'))
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $trucks->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th {
            font-weight: 600;
            font-size: 0.875rem;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .img-thumbnail {
            border: 2px solid #e9ecef;
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
        }

        .btn-group .btn {
            margin: 0 2px;
        }

        .empty-state {
            padding: 2rem 0;
        }

        .badge {
            font-size: 0.75rem;
        }

        .fw-semibold {
            font-weight: 600;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: true, // Menampilkan tombol "OK"
                    confirmButtonText: "OK", // Label tombol
                    confirmButtonColor: "#3085d6", // Warna tombol OK
                });
            @endif
        });
    </script>
@endsection
