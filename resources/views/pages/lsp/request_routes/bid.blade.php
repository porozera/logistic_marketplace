@extends('layouts.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container" style="background-color: white; border-radius:10px; padding:50px">
            <a href="/permintaan-pengiriman">Kembali</a>
            <h2>Ajukan Penawaran</h2>
            <form action="{{ route('bids.store') }}" method="POST">
                @csrf
                <input type="hidden" name="requestOffer_id" value="{{ $requestRoute->id }}">
                <div class="mb-3">
                    <label for="origin" class="form-label">Origin</label>
                    <input type="text" class="form-control" name="origin" value="{{ $requestRoute->origin }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" class="form-control" name="destination" value="{{ $requestRoute->destination }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shipmentMode" class="form-label">Shipment Mode</label>
                    <input type="text" class="form-control" name="shipmentMode" value="{{ $requestRoute->shipmentMode }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shipmentType" class="form-label">Shipment Type</label>
                    <input type="text" class="form-control" name="shipmentType" value="{{ $requestRoute->shipmentType }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shippingDate" class="form-label">Shipping Date</label>
                    <input type="date" class="form-control" name="shippingDate" value="{{ $requestRoute->shippingDate }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="commodities" class="form-label">Commodities</label>
                    <input type="text" class="form-control" name="commodities" value="{{ $requestRoute->commodities }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="loadingDate" class="form-label">Loading Date</label>
                    <input type="date" class="form-control" name="loadingDate" required>
                </div>
                <div class="mb-3">
                    <label for="estimationDate" class="form-label">Estimation Date</label>
                    <input type="date" class="form-control" name="estimationDate" required>
                </div>
                <div class="mb-3">
                    <label for="maxWeight" class="form-label">Max Weight (Kg)</label>
                    <input type="number" class="form-control" name="maxWeight" required>
                </div>
                <div class="mb-3">
                    <label for="maxVolume" class="form-label">Max Volume (CBM)</label>
                    <input type="number" class="form-control" name="maxVolume" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price (IDR)</label>
                    <input type="number" class="form-control" name="price" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajukan Penawaran</button>
            </form>
        </div>
    </div>
</div>

@endsection
