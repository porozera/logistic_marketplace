@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Detail Offer')

@section('content')
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="pc-container">
        <div class="pc-content">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Rute</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Rute</th>
                            <td>{{ $offer->id }}</td>
                        </tr>
                        <tr>
                            <th>No Offer</th>
                            <td>{{ $offer->noOffer }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Asal</th>
                            <td>{{ $offer->origin }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Tujuan</th>
                            <td>{{ $offer->destination }}</td>
                        </tr>
                        <tr>
                            <th>Shipment Mode</th>
                            <td>{{ $offer->shipmentMode }}</td>
                        </tr>
                        <tr>
                            <th>Shipment Type</th>
                            <td>{{ $offer->shipmentType }}</td>
                        </tr>
                        <tr>
                            <th>Tipe Container</th>
                            <td>{{ $offer->container->name }}</td>
                        </tr>
                        <tr>
                            <th>Max Weight</th>
                            <td>{{ $offer->maxWeight }}</td>
                        </tr>
                        <tr>
                            <th>Max Volume</th>
                            <td>{{ $offer->maxVolume }}</td>
                        </tr>
                        {{-- <tr>
                            <th>Commodities</th>
                            <td>{{ $offer->commodities }}</td>
                        </tr> --}}
                        <tr>
                            <th>Price</th>
                            <td>Rp. {{ number_format($offer->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Loading Date</th>
                            <td>{{ \Carbon\Carbon::parse($offer->loadingDate)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            {{-- <th>Shipping Date</th>
                            <td>{{ \Carbon\Carbon::parse($offer->shippingDate)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Estimation Date</th>
                            <td>{{ \Carbon\Carbon::parse($offer->estimationDate)->translatedFormat('l, d F Y') }}</td>
                        </tr> --}}
                        <tr>
                            <th>Remaining Weight</th>
                            <td>{{ $offer->remainingWeight }}</td>
                        </tr>
                        <tr>
                            <th>Remaining Volume</th>
                            <td>{{ $offer->remainingVolume }}</td>
                        </tr>
                        <tr>
                            <th>First Truck</th>
                            <td>{{ $offer->truck_first->plateNumber }} - {{ $offer->truck_first->driverName }} -
                                {{ $offer->truck_first->brand }} {{ $offer->truck_first->type }}</td>
                        </tr>
                        <tr>
                            <th>Second Truck</th>
                            <td>{{ $offer->truck_second->plateNumber }} - {{ $offer->truck_second->driverName }} -
                                {{ $offer->truck_second->brand }} {{ $offer->truck_second->type }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $offer->status }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('offers.destroy', $offer->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus offer ini?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
