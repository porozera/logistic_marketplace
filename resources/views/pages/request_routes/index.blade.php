@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
 <!-- [ Main Content ] start -->
 <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <h5 class="m-b-10">Permintaan Pengiriman</h5>
              </div>
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Home</li>
                </ul> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Detail Pengiriman</h4>
              <br>
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Lokasi Asal</label>
                                <input type="text" name="origin" class="form-control" placeholder="Lokasi Asal" value="{{ old('origin') }}">
                                @error('origin') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Lokasi Tujuan</label>
                                <input type="text" name="destination" class="form-control" placeholder="Lokasi Tujuan" value="{{ old('destination') }}">
                                @error('destination') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal Pengiriman</label>
                                <input type="date" name="shippingDate" class="form-control" placeholder="Tanggal Pengiriman" value="{{ old('shippingDate') }}">
                                @error('shippingDate') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Tipe Pengiriman</label>
                                <select class="form-control" name="shipmentType" id="shipmentType">
                                    <option value="FCL">FCL</option>
                                    <option value="LCL">LCL</option>
                                </select>
                                @error('shipmentType') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                            <label class="form-label">Mode Pengiriman</label>
                            <select class="form-control" name="shipmentMode" id="shipmentMode">
                                <option value="Laut">Laut</option>
                                <option value="Darat">Darat</option>
                            </select>
                            @error('shipmentMode') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4 class="mb-2">Detail Barang</h4>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Panjang</label>
                                <input type="number" name="length" class="form-control" placeholder="cm" value="{{ old('length') }}">
                                @error('length') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Lebar</label>
                                <input type="number" name="width" class="form-control" placeholder="cm" value="{{ old('width') }}">
                                @error('width') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tinggi</label>
                                <input type="number" name="height" class="form-control" placeholder="cm" value="{{ old('height') }}">
                                @error('height') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Berat</label>
                                <input type="number" name="weight" class="form-control" placeholder="kg" value="{{ old('weight') }}">
                                @error('weight') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-control" name="commodities" id="commodities">
                                    <option value="General Cargo">General Cargo</option>
                                    <option value="Special Cargo">Special Cargo</option>
                                </select>
                                @error('commodities') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div> 
                        <div class="col-md-10 text-end">
                            <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
                        </div> 
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
@endsection