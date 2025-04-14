@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@section('title', 'abc')

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h1>Kelola Rute</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-15">
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="mb-3">Daftar Rute</h3>
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                             @endif
                            <div style="display: flex; justify-content:space-between" class="mb-2">
                                <li class="pc-h-item d-none d-md-inline-flex" style="align-items: center">
                                    <i data-feather="search" class="icon-search" style="margin-right: 10px"></i>
                                    <input id="search" type="text" class="form-control" placeholder="Search . . ." style="width:500px">
                                    {{-- <button class="btn" style="margin-left: 10px; border: solid 0.5px; border-color: #F1F1F1">Filter<i class="ti ti-filter"></i></button> --}}
                                    <!-- Tombol Filter -->
                                    <div style="position: relative; margin-left:5px">
                                        <button class="btn btn-primary" id="filterButton">
                                            <i class="ti ti-filter"></i> Filter
                                        </button>

                                        <!-- Dropdown Filter -->
                                        <div id="filterDropdown" style="
                                            display: none;
                                            position: absolute;
                                            top: 100%;
                                            right: 0;
                                            background: white;
                                            border: 1px solid #ddd;
                                            padding: 20px;
                                            z-index: 1000;
                                            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
                                            min-width: 300px;">

                                            <form id="filterForm">
                                                <div class="mb-2">
                                                    <label for="originFilter">Lokasi Asal</label>
                                                    <select id="originFilter" name="origin" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach($origins as $origin)
                                                            <option value="{{ $origin }}">{{ $origin }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="destinationFilter">Lokasi Tujuan</label>
                                                    <select id="destinationFilter" name="destination" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach($destinations as $destination)
                                                            <option value="{{ $destination }}">{{ $destination }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="shipmentTypeFilter">Shipment Type</label>
                                                    <select id="shipmentTypeFilter" name="shipmentType" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="FCL">FCL</option>
                                                        <option value="LCL">LCL</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Terapkan</button>
                                            </form>
                                        </div>
                                    </div>

                                </li>
                                {{-- <button class="btn btn-primary"><a href="/offers/create" style="color: white">Tambah Rute</a></button> --}}
                                <a href="/offers/create" class="btn btn-primary" style="align-content: center">Tambah Rute</a>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Rute</th>
                                        <th>Lokasi Asal</th>
                                        <th>Lokasi Tujuan</th>
                                        <th>Shipment Type</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="offers-table">
                                    @forelse ($offers as $offer)
                                        <tr>
                                            <td>{{ $offer->id }}</td>
                                            <td>{{ $offer->origin }}</td>
                                            <td>{{ $offer->destination }}</td>
                                            <td>{{ $offer->shipmentType }}</td>
                                            <td class="text-end"><a href="{{ route('offers.show', $offer->id) }}">Lihat Detail</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No offers found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="pagination-container mt-5" style="display: flex; justify-content: space-between">
                                <div class="pagination-info">
                                    <p>Showing 10 of 10</p>
                                </div>
                                <div class="pagination-number">
                                    <ul class="pagination">
                                        <li class="page-item"><a href="#" class="page-link"><<</a></li>
                                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                                        <li class="page-item"><a href="#" class="page-link">>></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AJAX Live Search -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('offers.search') }}",
            type: "GET",
            data: { search: query },
            success: function(data) {
                $('#offers-table').html(data);
            }
        });
    });
</script>
<script>
    document.getElementById('filterButton').addEventListener('click', function() {
    const dropdown = document.getElementById('filterDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const origin = document.getElementById('originFilter').value;
    const destination = document.getElementById('destinationFilter').value;
    const shipmentType = document.getElementById('shipmentTypeFilter').value;

    fetch("{{ route('offers.index') }}?origin=" + origin + "&destination=" + destination + "&shipmentType=" + shipmentType)
        .then(response => response.text())
        .then(data => {
            document.getElementById('offersTable').innerHTML = data;
        });
});

</script>
@endsection
