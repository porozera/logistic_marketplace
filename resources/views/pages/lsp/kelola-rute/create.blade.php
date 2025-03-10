@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Tambah Rute')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="card">
            <div class="card-header">
                <h5>Tambah Rute</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('offers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="noOffer" class="form-label">No Offer</label>
                        <input type="text" id="noOffer" name="noOffer" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="origin" class="form-label">Origin</label>
                        <input type="text" id="origin" name="origin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" id="destination" name="destination" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="shipmentMode" class="form-label">Shipment Mode</label>
                        <select id="shipmentMode" name="shipmentMode" class="form-select" required>
                            <option value="laut">Laut</option>
                            <option value="darat">Darat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shipmentType" class="form-label">Shipment Type</label>
                        <select id="shipmentType" name="shipmentType" class="form-select" required>
                            <option value="FCL">FCL</option>
                            <option value="LCL">LCL</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="maxWeight" class="form-label">Max Weight</label>
                        <input type="number" id="maxWeight" name="maxWeight" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="maxVolume" class="form-label">Max Volume</label>
                        <input type="number" id="maxVolume" name="maxVolume" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="commodities" class="form-label">Commodities</label>
                        <input type="text" id="commodities" name="commodities" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" id="price" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="loadingDate" class="form-label">Loading Date</label>
                        <input type="date" id="loadingDate" name="loadingDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="shippingDate" class="form-label">Shipping Date</label>
                        <input type="date" id="shippingDate" name="shippingDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="estimationDate" class="form-label">Estimation Date</label>
                        <input type="date" id="estimationDate" name="estimationDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="remainingWeight" class="form-label">Remaining Weight</label>
                        <input type="number" id="remainingWeight" name="remainingWeight" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="remainingVolume" class="form-label">Remaining Volume</label>
                        <input type="number" id="remainingVolume" name="remainingVolume" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
