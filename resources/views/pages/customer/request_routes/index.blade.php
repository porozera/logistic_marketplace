@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Permintaan Rute')
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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Permintaan Rute</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
            <h3 class="m-b-10">Permintaan Rute</h3>
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Detail Pengiriman</h4>

              <br>
                <form action="/request-routes/perform" method="POST" id="requestRouteAddForm">
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
                                    <option value="FCL">Full Container Load (FCL)</option>
                                    <option value="LCL">Less Container Load (LCL)</option>
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
                                <label class="form-label">Panjang (cm)</label>
                                <input type="number" name="length" class="form-control" placeholder="cm" value="{{ old('length') }}">
                                @error('length') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Lebar (cm)</label>
                                <input type="number" name="width" class="form-control" placeholder="cm" value="{{ old('width') }}">
                                @error('width') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tinggi (cm)</label>
                                <input type="number" name="height" class="form-control" placeholder="cm" value="{{ old('height') }}">
                                @error('height') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Berat (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="kg" value="{{ old('weight') }}">
                                @error('weight') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-control" name="commodities" id="commodities">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->name }}">{{ $item->code }} - {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('commodities') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Deskripsi">{{ old('description') }}</textarea>
                            @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            
                        </div> 
                        <div class="col-md-10 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Permintaan</button>
                        </div> 
                    </div>
                </form>
            </div>
          </div>

            <div class="card">
            <div class="card-body">
            <h4 class="mb-2">List Permintaan Rute</h4>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-hover" id="pc-dt-simple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Tipe</th>
                            <th>Moda</th>
                            <th>Berat</th>
                            <th>Volume</th> 
                            <th>Jenis Barang</th> 
                            <th>Tangal Pengiriman</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = ($list_request->currentPage() - 1) * $list_request->perPage() + 1
                        @endphp
                        @foreach ( $list_request as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item['origin']}}</td>
                            <td>{{$item['destination']}}</td>
                            <td>{{$item['shipmentType']}}</td>
                            <td>{{$item['shipmentMode']}}</td>
                            <td>{{$item['weight']}} kg</td>
                            <td>{{$item['volume']}} CBM</td>
                            <td>{{$item['commodities']}}</td>
                            <td>{{$item['shippingDate']}}</td>
                            <td>{{$item['deadline']}}</td>
                    
                            <td>
                            @if ($item['status'] == "active")
                            <span class="badge rounded-pill text-bg-warning">In Bidding</span>
                            @else
                            <span class="badge rounded-pill text-bg-success">Close</span>
                            @endif
                            </td>
                            <td class="text-center">
                            <a href="/list-offer">Lihat Penawaran</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                {{ $list_request->links('pagination::bootstrap-4') }}
                </div> 
                </div>
                </div>
            </div>

      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin melakukan permintaan rute ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('requestRouteAddForm').submit();
            });
        </script>
@endsection