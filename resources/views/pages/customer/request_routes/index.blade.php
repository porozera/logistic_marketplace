@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Request Routes')
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
                    <li class="breadcrumb-item" aria-current="page">Request Routes</li>
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
            <h4 class="m-b-10">Request Routes</h4>
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
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Alamat Pick Up</label>
                                <textarea class="form-control" name="originAddress" rows="3" placeholder="Alamat Tujuan Pengiriman">{{ old('originAddress') }}</textarea>
                                @error('originAddress') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Alamat Tujuan</label>
                                <textarea class="form-control" name="destinationAddress" rows="3" placeholder="Alamat Tujuan Pengiriman">{{ old('destinationAddress') }}</textarea>
                                @error('destinationAddress') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tipe Pengiriman</label>
                                <select class="form-control" name="shipmentType" id="shipmentType">
                                    <option value="LCL" {{ old('shipmentType', 'LCL') == 'LCL' ? 'selected' : '' }}>Less Container Load (LCL)</option>
                                    <option value="FCL" {{ old('shipmentType') == 'FCL' ? 'selected' : '' }}>Full Container Load (FCL)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                            <label class="form-label">Jalur Pengiriman</label>
                            <select class="form-control" name="transportationMode" id="transportationMode">
                                <option value="laut">Laut</option>
                                <option value="darat">Darat</option>
                            </select>
                            @error('transportationMode') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Sampai</label>
                            <input type="date" name="arrivalDate" class="form-control" value="{{ old('arrivalDate') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Siap Muat Barang</label>
                            <div class="input-group">
                                <input type="date" name="RTL_start_date" class="form-control" value="{{ old('RTL_start_date') }}">
                                <span class="input-group-text">s/d</span>
                                <input type="date" name="RTL_end_date" class="form-control" value="{{ old('RTL_end_date') }}">
                            </div>
                            <div class="row">
                                <div class="col-6">@error('RTL_start_date') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror</div>
                                <div class="col-6">@error('RTL_end_date') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror</div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div id="containerDetail"></div>


                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="form-label">Informasi Tambahan</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="">{{ old('description') }}</textarea>
                            @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-10 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Permintaan</button>
                        </div>
                        <div class="row">
                    <div class="col">
                      @if ($errors->any())
                      <div class="alert alert-danger w-100">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                      @endif
                    </div>
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
                            <th class="text-center"><small>No</small></th>
                            <th class="text-center"><small>Asal</small></th>
                            <th class="text-center"><small>Tujuan</small></th>
                            <th class="text-center"><small>Jalur</small></th>
                            <th class="text-center"><small>Tipe</small></th>
                            <th class="text-center"><small>Moda</small></th>
                            <th class="text-center"><small>Tangal Sampai</small></th>
                            <th class="text-center"><small>Status</small></th>
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
                                <td class="text-center"><small>{{$no++}}</small></td>
                                <td class="text-center"><small>{{$item['origin']}}</small></td>
                                <td class="text-center"><small>{{$item['destination']}}</small></td>
                                <td class="text-center"><small>{{ $item['transportationMode'] }}</small></td>
                                <td class="text-center"><small>{{$item['shipmentType']}}</small></td>
                                <td class="text-center"><small>{{$item['shipmentMode']}}</small></td>
                                {{-- <td>{{$item['weight']}} kg</td>
                                <td>{{$item['volume']}} CBM</td>
                                <td>{{$item['commodities']}}</td> --}}
                                <td class="text-center"><small>{{$item->getarrivaldate()}}</small></td>

                                <td class="text-center">
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
        <template id="templateLCL">
            <div id="lclContainerDetail">
                        <h4 class="mb-0">Detail Muatan</h4>
                        <br>
                        <div class="row">
                        <div id="itemsContainer">
                            @php
                                $oldItems = old('items', [ [] ]);
                            @endphp
                            @foreach ($oldItems as $i => $item)
                            <div class="item-row border p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-11">
                                        <select class="form-control" name="items[{{ $i }}][commodities]">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->name}}" {{ (old("items.$i.commodities", $item['commodities'] ?? '') == $category->name) ? 'selected' : '' }}>
                                                    {{$category->code}} - {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-icon btn-light-danger remove-item"><i class="ti ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][length]" class="form-control length" placeholder="Panjang" value="{{ old("items.$i.length", $item['length'] ?? '') }}">
                                            <span class="input-group-text"><i class="ti ti-x"></i></span>
                                            <input type="number" name="items[{{ $i }}][width]" class="form-control width" placeholder="Lebar" value="{{ old("items.$i.width", $item['width'] ?? '') }}">
                                            <span class="input-group-text"><i class="ti ti-x"></i></span>
                                            <input type="number" name="items[{{ $i }}][height]" class="form-control height" placeholder="Tinggi" value="{{ old("items.$i.height", $item['height'] ?? '') }}">
                                            <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][weight]" class="form-control weight" placeholder="Berat" value="{{ old("items.$i.weight", $item['weight'] ?? '') }}">
                                            <span class="input-group-text"> kg</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][qty]" class="form-control qty" placeholder="Qty" value="{{ old("items.$i.qty", $item['qty'] ?? '') }}">
                                            <span class="input-group-text"> qty</span>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group mb-3">
                                                <input type="number" name="items[{{ $i }}][volume]" class="form-control volume" value="{{ old("items.$i.volume", $item['volume'] ?? '') }}" readonly>
                                                <span class="input-group-text"> CBM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-2">

                                    {{-- <button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        </div>
                        <div class="text-end mb-3">
                            <button type="button" id="addItemBtn" class="btn btn-secondary">+ Tambah Barang</button>
                        </div>
                    </div>
        </template>

        <template id="templateFCL">
            <div id="fclContainerDetail" >
                        <h4>Detail Kontainer</h4>
                        <div class="row">
                            <div id="itemsContainerFCL">
                                @php
                                    $oldItems = old('items', [ [] ]);
                                @endphp
                                <div class="item-row border p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">HS Code</label>
                                            <select class="form-control" name="items[{{ $i }}][commodities]">
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->name}}" {{ (old("items.$i.commodities", $item['commodities'] ?? '') == $category->name) ? 'selected' : '' }}>
                                                        {{$category->code}} - {{$category->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-2">
                                            <label class="form-label">Berat Muatan</label>
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[0][weight]" class="form-control weight" placeholder="" value="{{ old('items.0.weight', $oldItems[0]['weight'] ?? '') }}">
                                            <span class="input-group-text"> kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Qty Kontainer</label>
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[0][qty]" class="form-control qty" placeholder="" value="{{ old('items.0.qty', $oldItems[0]['qty'] ?? '') }}">
                                            <span class="input-group-text"> qty</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Volume</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="items[0][volume]" class="form-control volume" value="" readonly>
                                                <span class="input-group-text"> CBM</span>
                                            </div>
                                        </div>
                                        <input type="number" name="items[0][length]" class="form-control length" placeholder="Panjang (cm)" value=1 hidden>
                                        <input type="number" name="items[0][width]" class="form-control width" placeholder="Lebar (cm)" value=1 hidden>
                                        <input type="number" name="items[0][height]" class="form-control height" placeholder="Tinggi (cm)" value=1 hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </template>

       <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shipmentType = document.getElementById('shipmentType');
            const containerDetail = document.getElementById('containerDetail');
            const templateLCL = document.getElementById('templateLCL');
            const templateFCL = document.getElementById('templateFCL');

            function renderContainerDetail() {
            containerDetail.innerHTML = '';

            const template = shipmentType.value === 'FCL' ? templateFCL : templateLCL;
            const clone = template.content.cloneNode(true);

            const tempDiv = document.createElement('div');
            tempDiv.appendChild(clone);

            setTimeout(() => {
                setupAddItemListeners();
                registerCBMListeners && registerCBMListeners();
                calculateCBM && calculateCBM();
            }, 0);

            containerDetail.appendChild(tempDiv);
        }


            shipmentType.addEventListener('change', renderContainerDetail);
            renderContainerDetail();

            function setupAddItemListeners() {
            let itemIndex = 1;

            const addItemBtn = document.getElementById('addItemBtn');
            const itemsContainer = document.getElementById('itemsContainer');

            if (!addItemBtn || !itemsContainer) return;

            addItemBtn.addEventListener('click', function () {
                const newItem = itemsContainer.querySelector('.item-row').cloneNode(true);
                const itemIndex = itemsContainer.querySelectorAll('.item-row').length;

                newItem.querySelectorAll('input, select').forEach((input) => {
                const name = input.getAttribute('name');
                if (!name) return;
                const newName = name.replace(/\[\d+\]/, `[${itemIndex}]`);
                input.setAttribute('name', newName);

                if (input.classList.contains('volume')) {
                    input.value = 0;
                } else if (input.tagName === "SELECT") {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
                });

                itemsContainer.appendChild(newItem);
                registerCBMListeners && registerCBMListeners();
            });

            // Delegasi hapus
            itemsContainer.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.remove-item');
                if (removeBtn) {
                const rows = document.querySelectorAll('.item-row');
                if (rows.length > 1) {
                    removeBtn.closest('.item-row').remove();
                    calculateCBM();
                } else {
                    alert("Minimal harus ada satu item.");
                }
                }
            });
            }
        });
        </script>



        <script>
          function registerCBMListeners() {
            document.querySelectorAll(".item-row input").forEach(input => {
                input.removeEventListener("input", calculateCBM);
                input.addEventListener("input", calculateCBM);
            });
            document.querySelectorAll('.item-row select').forEach(select => {
                select.removeEventListener("change", calculateCBM);
                select.addEventListener("change", calculateCBM);
            });
            }

          function calculateCBM() {
            let shipmentType = document.getElementById("shipmentType").value;
            let maxWeightPerCBM = 600;
            let totalCBMToBuy = 0;
            let totalCBM = 0;

            if (shipmentType === 'FCL') {
            let maxVolume = 33;
            let qty = parseFloat(document.querySelector('input[name="items[0][qty]"]')?.value) || 0;
            let cbmToBuy = qty * maxVolume;
            totalCBMToBuy = cbmToBuy;
            totalCBM = cbmToBuy;

            // Set input volume pada FCL
            let volumeInput = document.querySelector('input[name="items[0][volume]"]');
            if (volumeInput) volumeInput.value = cbmToBuy;
                // Jika ingin set volumeInput pada FCL, bisa tambahkan di sini
            } else {
                const items = document.querySelectorAll(".item-row");
                items.forEach((item, idx) => {
                    let length = parseFloat(item.querySelector(".length")?.value) || 0;
                    let width = parseFloat(item.querySelector(".width")?.value) || 0;
                    let height = parseFloat(item.querySelector(".height")?.value) || 0;
                    let weight = parseFloat(item.querySelector(".weight")?.value) || 0;
                    let qty = parseFloat(item.querySelector(".qty")?.value) || 0;

                    let lengthM = length / 100;
                    let widthM = width / 100;
                    let heightM = height / 100;

                    let cbm = lengthM * widthM * heightM * qty;
                    let cbmByWeight = weight / maxWeightPerCBM;
                    let cbmToBuy = Math.max(cbm, cbmByWeight);

                    totalCBM += cbm;
                    totalCBMToBuy += cbmToBuy;

                    let volumeInput = item.querySelector('.volume');
                    if (
                        length === 0 &&
                        width === 0 &&
                        height === 0 &&
                        weight === 0 &&
                        qty === 0
                    ) {
                        if (volumeInput) volumeInput.value = 0;
                    } else {
                        if (volumeInput) volumeInput.value = cbm.toFixed(2);
                    }
                });
            }

            document.getElementById("cbmResult").innerText = totalCBM.toFixed(2);
            document.getElementById("cbmToBuy").innerText = totalCBMToBuy;

            updateTotalPrice();
            }
        </script>


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
