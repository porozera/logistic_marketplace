@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Permintaan Rute')
@section('content')
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.3/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.3/mapbox-gl-geocoder.css" type="text/css">

 <!-- [ Main Content ] start -->
 <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                @if(session('success'))
                <script>
                    Swal.fire({
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
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
            <h4 class="m-b-10">Buat Permintaan Rute</h4>
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Detail Pengiriman</h4>
              <br>
              {{-- <small class="text-muted text-small">*Masukan provinsi asal dan tujuan, lalu masukan kota asal dan tujuan.</small> --}}

                <form action="/request-routes/perform" method="POST" id="requestRouteAddForm">
                    @csrf
                    {{-- <div class="row mb-3">
                        <div class="col-md-6 ">
                            <label>Asal:</label>
                            <div id="origin-geocoder" style="min-width: 300px;"></div>
                            <input type="text" name="origin_lat" id="origin_lat">
                            <input type="text" name="origin_lng" id="origin_lng">
                        </div>
                        <div class="col-md-6">
                            <label>Tujuan:</label>
                            <div id="destination-geocoder" style="min-width: 300px;"></div>
                            <input type="hidden" name="destination_lat" id="destination_lat">
                            <input type="hidden" name="destination_lng" id="destination_lng">
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            mapboxgl.accessToken = 'pk.eyJ1IjoiYXVmYXJudWdyYXRhbWFwcyIsImEiOiJjbTkxZ2xkdW4wMHJpMmxvZTl1Z25zZWlrIn0.2pWYizs2qnqxUz6PeW7d-w';

                            const originGeocoder = new MapboxGeocoder({
                                accessToken: mapboxgl.accessToken,
                                types: 'place',
                                placeholder: 'Cari kota asal',
                                mapboxgl: mapboxgl
                            });

                            const destinationGeocoder = new MapboxGeocoder({
                                accessToken: mapboxgl.accessToken,
                                types: 'place',
                                placeholder: 'Cari kota tujuan',
                                mapboxgl: mapboxgl
                            });

                            originGeocoder.addTo('#origin-geocoder');
                            destinationGeocoder.addTo('#destination-geocoder');

                            originGeocoder.on('result', function(e) {
                                const coords = e.result.geometry.coordinates;
                                document.getElementById('origin_lat').value = coords[1];
                                document.getElementById('origin_lng').value = coords[0];
                            });

                            destinationGeocoder.on('result', function(e) {
                                const coords = e.result.geometry.coordinates;
                                document.getElementById('destination_lat').value = coords[1];
                                document.getElementById('destination_lng').value = coords[0];
                            });
                        });
                    </script> --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Provinsi Asal</label>
                                <select id="origin_province" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Kota Asal</label>
                                <select name="origin" id="origin_city" class="form-control"></select>
                                @error('origin') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Provinsi Tujuan</label>
                                <select id="destination_province" class="form-control"></select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Kota Tujuan</label>
                                <select name="destination" id="destination_city" class="form-control"></select>
                                @error('destination') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        
                        <script>
                            // Load provinsi saat halaman pertama kali dibuka
                            const loadProvinces = async (selectId) => {
                                const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`);
                                const provinces = await res.json();
                                const select = document.getElementById(selectId);
                                select.innerHTML = `<option value="">Pilih Provinsi</option>`;
                                provinces.forEach(p => {
                                    select.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                                });
                            }
                        
                            // Load kota/kabupaten berdasarkan provinsi
                            const loadCities = async (provinceId, targetSelectId) => {
                                const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`);
                                const cities = await res.json();
                                const select = document.getElementById(targetSelectId);
                                select.innerHTML = `<option value="">Pilih Kota/Kabupaten</option>`;
                                cities.forEach(c => {
                                    select.innerHTML += `<option value="${c.name}">${c.name}</option>`;
                                });
                            }
                        
                            // Load provinsi saat awal
                            loadProvinces("origin_province");
                            loadProvinces("destination_province");
                        
                            // Event Listener untuk load kota berdasarkan provinsi
                            document.getElementById("origin_province").addEventListener("change", function () {
                                loadCities(this.value, "origin_city");
                            });
                        
                            document.getElementById("destination_province").addEventListener("change", function () {
                                loadCities(this.value, "destination_city");
                            });
                        </script>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tipe Pengiriman</label>
                                <select class="form-control" name="shipmentType" id="shipmentType">
                                    <option value="LCL">LCL</option>
                                    <option value="FCL">FCL</option>
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label class="form-label">Mode Pengiriman</label>
                            <select class="form-control" name="shipmentMode" id="shipmentMode">
                                <option value="D2D">Door to Door (D2D)</option>
                                <option value="D2P">Door to Port (D2P)</option>
                                <option value="P2P">Port to Port (P2P)</option>
                                <option value="P2D">Port to Door (P2D)</option>
                            </select>                            
                            @error('shipmentMode') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
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
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat Tujuan Pengiriman</label>
                            <textarea class="form-control" name="address" rows="4" placeholder="Alamat Tujuan Pengiriman">{{ old('address') }}</textarea>
                            @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
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
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Berat (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="kg" value="{{ old('weight') }}">
                                @error('weight') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Kategori Barang</label>
                                <select class="form-control" name="commodities" id="commodities">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->name }}">{{ $item->code }} - {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('commodities') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tipe Kontainer</label>
                                <select class="form-control" name="container_id" id="container_id">
                                    @foreach ($containers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                <table class="table table-hover" id="pc-dt-simple" style="min-width: 1200px;">
                    <thead>
                        <tr>
                            <th><small>No</small></th>
                            <th><small>Asal</small></th>
                            <th><small>Tujuan</small></th>
                            <th><small>Alamat Tujuan</small></th>
                            <th><small>Tipe</small></th>
                            <th><small>Moda</small></th>
                            {{-- <th>Berat</th>
                            <th>Volume</th> 
                            <th>Jenis Barang</th>  --}}
                            <th><small>Tangal Pengiriman</small></th>
                            <th><small>Status</small></th>
                            <th class="text-center"><small>Actions</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = ($list_request->currentPage() - 1) * $list_request->perPage() + 1
                        @endphp
                        @if ($list_request->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center">Tidak Ada Data Permintaan</td>
                        </tr>
                        @else
                            @foreach ( $list_request as $item)
                            <tr>
                                <td><small>{{$no++}}</small></td>
                                <td><small>{{$item['origin']}}</small></td>
                                <td><small>{{$item['destination']}}</small></td>
                                <td><small>{{ Str::limit($item['address'], 25, '...') }}</small></td>
                                <td><small>{{$item['shipmentType']}}</small></td>
                                <td><small>{{$item['shipmentMode']}}</small></td>
                                {{-- <td>{{$item['weight']}} kg</td>
                                <td>{{$item['volume']}} CBM</td>
                                <td>{{$item['commodities']}}</td> --}}
                                <td><small>{{$item['shippingDate']}}</small></td>
                        
                                <td>
                                @if ($item['status'] == "active")
                                <span class="badge rounded-pill text-bg-warning">In Bidding</span>
                                @else
                                <span class="badge rounded-pill text-bg-success">Close</span>
                                @endif
                                </td>
                                <td class="text-center">
                                <a href="/list-offer"><small>Lihat Penawaran</small></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
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

        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
@endsection