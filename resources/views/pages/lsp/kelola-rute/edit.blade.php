@extends('layouts.app')

@section('title', 'Edit Rute')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Detail Offer</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="noOffer" class="form-label">No Offer</label>
                            <input type="text" class="form-control" id="noOffer" name="noOffer" value="{{ $offer->noOffer }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control" id="origin" name="origin" value="{{ $offer->origin }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" value="{{ $offer->destination }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="shipmentMode" class="form-label">Shipment Mode</label>
                            <select class="form-select" id="shipmentMode" name="shipmentMode" required>
                                <option value="laut" {{ $offer->shipmentMode == 'laut' ? 'selected' : '' }}>Laut</option>
                                <option value="darat" {{ $offer->shipmentMode == 'darat' ? 'selected' : '' }}>Darat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shipmentType" class="form-label">Shipment Type</label>
                            <select class="form-select" id="shipmentType" name="shipmentType" required>
                                <option value="FCL" {{ $offer->shipmentType == 'FCL' ? 'selected' : '' }}>FCL</option>
                                <option value="LCL" {{ $offer->shipmentType == 'LCL' ? 'selected' : '' }}>LCL</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="maxWeight" class="form-label">Max Weight</label>
                            <input type="number" class="form-control" id="maxWeight" name="maxWeight" value="{{ $offer->maxWeight }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="maxVolume" class="form-label">Max Volume</label>
                            <input type="number" class="form-control" id="maxVolume" name="maxVolume" value="{{ $offer->maxVolume }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ $offer->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="truck_id" class="form-label">Jenis Truk</label>
                            <select class="form-select" name="truck_id" id="truck_id" required>
                                @foreach($trucks as $truck)
                                    <option value="{{ $truck->id }}" {{ $offer->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->type }} - {{$truck->brand}} - {{ $truck->plateNumber }} ({{$truck->driverName}}) </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Offer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
