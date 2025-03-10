@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Detail Offer')

@section('content')

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
                        <th>Max Weight</th>
                        <td>{{ $offer->maxWeight }}</td>
                    </tr>
                    <tr>
                        <th>Max Volume</th>
                        <td>{{ $offer->maxVolume }}</td>
                    </tr>
                    <tr>
                        <th>Commodities</th>
                        <td>{{ $offer->commodities }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $offer->status }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $offer->price }}</td>
                    </tr>
                    <tr>
                        <th>Loading Date</th>
                        <td>{{ $offer->loadingDate }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Date</th>
                        <td>{{ $offer->shippingDate }}</td>
                    </tr>
                    <tr>
                        <th>Estimation Date</th>
                        <td>{{ $offer->estimationDate }}</td>
                    </tr>
                    <tr>
                        <th>Remaining Weight</th>
                        <td>{{ $offer->remainingWeight }}</td>
                    </tr>
                    <tr>
                        <th>Remaining Volume</th>
                        <td>{{ $offer->remainingVolume }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus offer ini?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
