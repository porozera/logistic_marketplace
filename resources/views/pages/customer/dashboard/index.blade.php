@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Dashboard')
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
                            
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Order</a></li> --}}
                            {{-- <li class="breadcrumb-item" aria-current="page">Dashboard</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>Hello, {{ Auth::user()->firstName }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12 col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mt-2 text-primary">Total Pemesanan</h5> 
                                            <i class="ti ti-package ms-2 text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <br>
                                        <h4>{{$totalPengiriman}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mt-2 text-success">Pemesanan Aktif</h5> 
                                            <i class="ti ti-truck-delivery ms-2 text-success" style="font-size: 24px;"></i>
                                        </div> 
                                        <br>
                                        <h4>{{$pengirimanBerjalan}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mt-2 text-warning">Pembayaran Tertunda</h5> 
                                            <i class="ti ti-clock ms-2 text-warning" style="font-size: 24px;"></i>
                                        </div> 
                                        <br>
                                        <h4>{{$pembayaranTertunda}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md">
                                <div class="card">
                                    <div class="card-body text-center">
                                            <p class="">Dapatkan harga kompetitif di pengiriman mu.</p>
                                            <a href="/search-routes" class="btn btn-primary">Cari Rute Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- @foreach ($latestTrackings as $location)
                            <div>
                                {{ $location->order_id }} - {{ $location->latitude }} , {{ $location->longitude }}
                            </div>
                        @endforeach --}}
                    <div class="d-flex align-items-center">
                        <h5 class="fw-bold">Lokasi Pengiriman Terakhir</h5>
                        <i class="ti ti-map-pin text-danger ms-2 mb-2"></i>
                    </div>

                    <div id="map" style="width: 100%; height: 400px;"></div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            mapboxgl.accessToken = 'pk.eyJ1IjoiYXVmYXJudWdyYXRhbWFwcyIsImEiOiJjbTkxZ2xkdW4wMHJpMmxvZTl1Z25zZWlrIn0.2pWYizs2qnqxUz6PeW7d-w';
                    
                            const map = new mapboxgl.Map({
                                container: 'map',
                                style: 'mapbox://styles/aufarnugratamaps/cm91i1s4m00al01s43z35bik2',
                                center: [106.82, -6.2],
                                zoom: 5,
                            });
                    
                            const bounds = new mapboxgl.LngLatBounds();
                    
                            const markers = [
                                @foreach ($latestTrackings as $location)
                                    @php
                                        $lng = $location->longitude;
                                        $lat = $location->latitude;
                                    @endphp
                    
                                    @if (is_numeric($lng) && is_numeric($lat) && $lat != 0 && $lng != 0)
                                        {
                                            lng: {{ $lng }},
                                            lat: {{ $lat }},
                                            vehicle: "{{ strtolower($location->currentVehicle) }}",
                                            popup: `<strong>No Pengiriman:</strong> {{ $location->order->noOffer }}<br><strong>Location:</strong> {{ $location->currentLocation }}<br><strong>Vehicle:</strong> {{ $location->currentVehicle }}`
                                        },
                                    @endif
                                @endforeach
                            ];
                    
                            function createMarker() {
                                markers.forEach(function(coord) {
                                    const el = document.createElement('div');
                                    el.className = 'custom-marker';

                                    let iconUrl = '';

                                    if (coord.vehicle === 'truck' || coord.vehicle === 'truk') {
                                        iconUrl = "{{ asset('images/truck-icon3.png') }}";
                                    } else if (coord.vehicle === 'ship' || coord.vehicle === 'kapal') {
                                        iconUrl = "{{ asset('images/ship-icon.png') }}";
                                    } else {
                                        iconUrl = "{{ asset('images/ship-icon.png') }}"; 
                                    }

                                    el.style.backgroundImage = `url('${iconUrl}')`;
                                    el.style.width = '50px';
                                    el.style.height = '50px';
                                    el.style.backgroundSize = 'cover';

                                    new mapboxgl.Marker(el)
                                        .setLngLat([coord.lng, coord.lat])
                                        .setPopup(new mapboxgl.Popup().setHTML(coord.popup))
                                        .addTo(map);

                                    bounds.extend([coord.lng, coord.lat]);
                                });

                                if (!bounds.isEmpty()) {
                                    map.fitBounds(bounds, { padding: 70, maxZoom: 12 });
                                }
                            }

                    
                            createMarker();
                        });
                    </script>
                    
                    
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold">Daftar Pengiriman</h5>
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><small>Nomor Pengiriman</small></th>
                                        <th class="text-center"><small>LSP</small></th>
                                        <th class="text-center"><small>Asal</small></th>
                                        <th class="text-center"><small>Tujuan</small></th>
                                        <th class="text-center"><small>Berat</small></th>
                                        <th class="text-center"><small>Volume</small></th>
                                        <th class="text-center"><small>Status</small></th>
                                        <th class="text-center"><small>Action</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userOrder->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak Ada Data Pengiriman</td>
                                    </tr>
                                    @else
                                        @foreach ($userOrder as $item)
                                        <tr>
                                            <td class="text-center text-primary"><small>{{$item->order->noOffer}}</small></td>
                                            <td class="text-center"><small>{{$item->order->lsp->companyName}}</small></td>
                                            <td class="text-center"><small>{{ $item->order->origin }}</small></td>
                                            <td class="text-center"><small>{{$item->order->destination}}</small></td>
                                            <td class="text-center"><small>{{$item->getTotalWeightAttribute()}} Kg</small></td>
                                            <td class="text-center"><small>{{$item->getTotalVolumeAttribute()}} CBM</small></td>
                                            <td class="text-center">
                                                @if ($item->order->status == "Loading Item")
                                                <span class="badge rounded-pill text-bg-warning" style="font-size: 14px;">Loading Item</span>
                                                @elseif ($item->order->status == "On The Way")
                                                <span class="badge rounded-pill text-bg-primary" style="font-size: 14px;">On The Way</span>
                                                @elseif ($item->order->status == "Finished")
                                                <span class="badge rounded-pill text-bg-success" style="font-size: 14px;">Finished</span>
                                                @else
                                                {{$item->order->status}}
                                                @endif
                                            </td>
                                            <td class="text-center"><a href="/tracking/detail/{{$item->id}}"><small>Track</small></a></td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
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
                        Apakah Anda yakin menghapus ulasan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger" id="submitFormButton">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('reviewDeleteForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
@endsection