@extends('layouts.app')

@section('title', 'Add Route')

@section('content')
<div class="container" style="padding-left: 250px; padding-top:80px;">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Route</a></li>
                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Create Route</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <div class="card">
        <div class="card-header">
          <h5>Form Tambah Route</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('offers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="origin" class="form-label">Origin</label>
                    <input type="text" name="origin" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" name="destination" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="shipmentMode" class="form-label">Shipment Mode</label>
                    <select name="shipmentMode" class="form-control" required>
                        <option value="laut">Laut</option>
                        <option value="darat">Darat</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="shipmentType" class="form-label">Shipment Type</label>
                    <select name="shipmentType" class="form-control" required>
                        <option value="FCL">FCL</option>
                        <option value="LCL">LCL</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="maxWeight" class="form-label">Max Weight</label>
                    <input type="number" name="maxWeight" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="maxVolume" class="form-label">Max Volume</label>
                    <input type="number" name="maxVolume" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="commodities" class="form-label">Commodities</label>
                    <input type="text" name="commodities" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="loadingDate" class="form-label">Loading Date</label>
                    <input type="date" name="loadingDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="shippingDate" class="form-label">Shipping Date</label>
                    <input type="date" name="shippingDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="estimationDate" class="form-label">Estimation Date</label>
                    <input type="date" name="estimationDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="remainingWeight" class="form-label">Remaining Weight</label>
                    <input type="number" name="remainingWeight" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="remainingVolume" class="form-label">Remaining Volume</label>
                    <input type="number" name="remainingVolume" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="truck_id" class="form-label">Jenis Truk</label>
                    <select class="form-select" name="truck_id" id="truck_id" required>
                        <option value="">-- Pilih Truk --</option>
                        @foreach($trucks as $truck)
                            <option value="{{ $truck->id }}">{{ $truck->type }} - {{$truck->brand}} - {{ $truck->plateNumber }} ({{$truck->driverName}}) </option>
                        @endforeach
                    </select>
                </div>

                <hr>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Offer</button>
            </form>

        </div>
      </div>

</div>
@endsection
