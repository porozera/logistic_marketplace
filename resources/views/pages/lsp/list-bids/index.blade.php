@extends('layouts.app')
@section('title', 'List Bids')
@section('content')
    @php
        \carbon\Carbon::setLocale('id');
    @endphp

    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Bids List</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12">
                    <h2 class="m-b-10">List Bidding</h2>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Offer</th>
                                        <th>Asal</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Muat</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tipe</th>
                                        <th>Moda</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($bids as $bid)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $bid->noOffer }}</td>
                                            <td>{{ $bid->origin }}</td>
                                            <td>{{ $bid->destination }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bid->loadingDate)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($bid->shippingDate)->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td>{{ $bid->shipmentType }}</td>
                                            <td>{{ ucfirst($bid->shipmentMode) }}</td>
                                            <td>{{ $bid->commodities }}</td>
                                            <td>Rp. {{ number_format($bid->price, 0, ',', '.') }}</td>
                                            <td>{{ ucfirst($bid->status) }}</td>
                                            {{-- <td>{{ $bid-> }}</td> --}}
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

@endsection
