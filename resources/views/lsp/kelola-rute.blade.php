@extends('lsp.layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

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
                            <div style="display: flex; justify-content:space-between" class="mb-2">
                                <li class="pc-h-item d-none d-md-inline-flex" style="align-items: center">
                                    <i data-feather="search" class="icon-search" style="margin-right: 10px"></i>
                                    <input id="search" type="text" class="form-control" placeholder="Search . . ." style="width:500px"> <input>
                                    <button class="btn btn-primary" style="margin-left: 10px"><i class="ti ti-filter"></i>Filter</button>
                                </li>
                                <button class="btn btn-primary"><a href="#" style="color: white">Tambah Rute</a></button>
                            </div>

                            <table class="table table-hover table-borderless mb-0">
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
                                            <td class="text-end"><a href="#">Lihat Detail</a></td>
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
@endsection
