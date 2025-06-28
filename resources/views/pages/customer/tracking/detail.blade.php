@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Detail Order')
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
                            <li class="breadcrumb-item" aria-current="page">Detail Order</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
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
        </div>
        @if ($review == 0 && $userOrder->order->status == 'selesai')
        {{-- @if ($review == 0) --}}
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <div class="card card-hover">
                    <div class="card-body">
                        <h5 class="text-center text-primary">Beri Ulasan</h5>
                        <br>
                        <form action="/review/create/perform" method="post" id="reviewAddForm">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="form-group text-center mb-3">
                                    <input type="hidden" name="ratingNumber" id="ratingNumber" value="{{ old('ratingNumber', 0) }}">
                                
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star fa-2x star-rating" data-value="{{ $i }}" style="cursor: pointer; color: #ccc;"></i>
                                    @endfor
                                
                                    @error('ratingNumber') 
                                        <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="description" rows="4" placeholder="Tulis pengalaman Anda disini!">{{ old('description') }}</textarea>
                                    @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <input type="number" name="lsp_id" class="form-control" value="{{ $userOrder->order->lsp_id }}" hidden>
                            <input type="number" name="order_id" class="form-control" value="{{ $userOrder->order->id }}" hidden>
                            <input type="number" name="userOrder_id" class="form-control" value="{{ $userOrder->id }}" hidden>
                            <span class="text-muted small">*Bagikan pengalaman Anda dengan LSP ini, pastikan untuk menyebutan detail yang mungkin dapat membantu pengguna lain.</span>
                            <div class="row">
                                <div class="col-12">
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
                            <div class="row justify-content-end">
                                <div class="col-md-4 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Ulasan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif  
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12 col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div id='map' style='width: 100%; height: 400px;'></div>
                        @php
                            $lng = $location->longitude ?? 0;
                            $lat = $location->latitude ?? 0;
                        @endphp
                        @php
                            $vehicle = strtolower($location->currentVehicle ?? '');
                            $iconUrl = asset('images/truck-icon.png');

                            if ($vehicle === 'truck' || $vehicle === 'truk') {
                                $iconUrl = asset('images/truck-icon3.png');
                            } elseif ($vehicle === 'ship') {
                                $iconUrl = asset('images/ship-icon.png');
                            }
                        @endphp
                        <script>
                            mapboxgl.accessToken = 'pk.eyJ1IjoiYXVmYXJudWdyYXRhbWFwcyIsImEiOiJjbTkxZ2xkdW4wMHJpMmxvZTl1Z25zZWlrIn0.2pWYizs2qnqxUz6PeW7d-w';

                            const map = new mapboxgl.Map({
                                container: 'map',
                                style: 'mapbox://styles/aufarnugratamaps/cm91i1s4m00al01s43z35bik2',
                                center: [{{ $lng }}, {{ $lat }}],
                                zoom: 12
                            });

                            window.addEventListener('resize', () => map.resize());

                            // Buat elemen HTML untuk marker
                            const el = document.createElement('div');
                            el.className = 'custom-marker';
                            el.style.backgroundImage = "url('{{ $iconUrl }}')";
                            el.style.width = '50px';
                            el.style.height = '50px';
                            el.style.backgroundSize = 'cover';

                            // Tambahkan marker dengan ikon custom
                            new mapboxgl.Marker(el)
                                .setLngLat([{{ $lng }}, {{ $lat }}])
                                .setPopup(new mapboxgl.Popup().setHTML(`<strong>Location:</strong> {{ $location->currentLocation }}<br><strong>Vehicle:</strong> {{ $location->currentVehicle }}`))
                                .addTo(map);
                        </script>

                        
                    </div>
                </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5>Detail Order</h5>
                                </div>
                                <div class="col text-end">
                                    <p class="text-primary d-inline">{{ $userOrder->order->noOffer }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6"><p>Total Harga</p></div>
                                <div class="col-md-6">
                                    <p class="text-primary">Rp. {{ number_format($userOrder->totalPrice, 0, ',', '.')}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><p>Mode Pengiriman</div>
                                <div class="col-md-6">
                                    @if ($userOrder->order->shipmentMode == 'D2D')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> <span class="text-primary">Door To Door</span> 
                                    @elseif ($userOrder->order->shipmentMode == 'D2P')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> <span class="text-primary">Door To Port</span> 
                                    @elseif ($userOrder->order->shipmentMode == 'P2D')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> <span class="text-primary">Port To Door</span>   
                                    @elseif ($userOrder->order->shipmentMode == 'P2P')
                                    <i class="ti ti-sailboat text-primary me-1"></i> <span class="text-primary">Port To Port</span> 
                                    @endif
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-md-6"><p>Tipe Pengiriman</p></div>
                                <div class="col-md-6">
                                    <p class="text-primary">
                                        {{ $userOrder->order->shipmentType == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Asal Pengiriman</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->origin }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col"><p>Tujuan Pengiriman</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->destination }}</p>
                                </div>
                            </div>
                            @if (!empty($userOrder->originAddress))
                            <div class="row">
                                <p>Alamat Pick Up :</p> 
                                <p class="text-primary">{{ $userOrder->originAddress }}</p>
                            </div>
                            @endif
                            @if (!empty($userOrder->destinationAddress))
                            <div class="row">
                                <p>Alamat Tujuan :</p> 
                                <p class="text-primary">{{ $userOrder->destinationAddress }}</p>
                            </div>
                            @endif
                            <hr> 

                            @if(!empty($userOrder->order->pickupAddress))
                            <div class="row">
                                <div class="col"><p>Tanggal Muat Barang</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->getpickupdate() }}</p>
                                </div>
                            </div>
                            @endif
                             <div class="d-flex justify-content-between align-items-center">
                                <p class="">Tanggal Pengiriman</p>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap" id="pc-dt-simple" style="min-width: 100px;">
                                    <thead>
                                        <tr>
                                            <th><p class="mb-0 text-center">Nama</p></th>
                                            <th><p class="mb-0 text-center">Tanggal</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($userOrder->order->pickupDate))
                                        <tr>
                                            <td><p class="mb-0 text-start">Pick Up Date</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getpickupdate() }}</p></td>
                                        </tr>
                                        @endif
                                        @if (!empty($userOrder->order->departureDate))
                                        <tr>
                                            <td><p class="mb-0 text-start">Truck Departure Date</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getdeparturedate() }}</p></td>
                                        </tr>
                                        @endif
                                        @if (!empty($userOrder->order->cyClosingDate))
                                        <tr>
                                            <td><p class="mb-0 text-start">CY Closing Date</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getcyclosingdate() }}</p></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td><p class="mb-0 text-start">Estimated Time Departure</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getetd() }}</p></td>
                                        </tr>
                                        <tr>
                                            <td><p class="mb-0 text-start">Estimated Time Arrival</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->geteta() }}</p></td>
                                        </tr>
                                        @if (!empty($userOrder->order->deliveryDate))
                                        <tr>
                                            <td><p class="mb-0 text-start">Delivery Date</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getdeliverydate() }}</p></td>
                                        </tr>
                                        @endif
                                        @if (!empty($userOrder->order->arrivalDate))
                                        <tr>
                                            <td><p class="mb-0 text-start">Arrival Date</p></td>
                                            <td><p class="mb-0 text-center">{{ $userOrder->order->getarrivaldate() }}</p></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            @if($services->isNotEmpty())
                            <hr>
                            <div class="row">
                                <div class="col"><p>Layanan Yang Dipesan</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $serviceNames }}</p>
                                </div>
                            </div>  
                            @endif
                        </div>
                    </div>
                </div>
                @if ($userOrder->order->shipmentType == 'FCL')
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Container</h5>
                                {{-- <span class="text-primary">{{ $userOrder->order->container->name ?? 'Tidak ada tipe kontainer' }}</span> --}}
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap" id="pc-dt-simple" style="min-width: 100px;">
                                    <thead>
                                        <tr>
                                            <th><p class="mb-0">Container</p></th>
                                            <th><p class="mb-0 text-center">Qty</p></th>
                                            <th><p class="mb-0 text-center">Volume Muatan</p></th>
                                            <th><p class="mb-0 text-center">Berat Muatan</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td><p class="mb-0">{{ $userOrder->order->container->name ?? 'Tidak ada tipe kontainer' }}</p></td>
                                            <td><p class="mb-0 text-center">{{$item->qty}}</p></td>
                                            <td><p class="mb-0 text-center">{{ (int) $item->volume }} CBM</p></td>
                                            <td><p class="mb-0 text-center">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
                @else
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Detail Muatan</h5>
                                <span class="text-primary">{{ $userOrder->order->container->name ?? 'Tidak ada tipe kontainer' }}</span>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap" id="pc-dt-simple" style="min-width: 100px;">
                                    <thead>
                                        <tr>
                                            <th><p class="mb-0">Nama Barang</p></th>
                                            <th><p class="mb-0 text-center">Qty</p></th>
                                            <th><p class="mb-0 text-center">Volume</p></th>
                                            <th><p class="mb-0 text-center">Berat</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalQty = 0;
                                            $totalVolume = 0;
                                            $totalWeight = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                            @php
                                                $totalQty += $item->qty;
                                                $totalVolume += $item->volume;
                                                $totalWeight += $item->weight;
                                            @endphp
                                            <tr>
                                                <td><p class="mb-0">{{$item->commodities}}</p></td>
                                                <td><p class="mb-0 text-center">{{$item->qty}}</p></td>
                                                <td><p class="mb-0 text-center">{{ (int) $item->volume }} CBM</p></td>
                                                <td><p class="mb-0 text-center">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th><p class="mb-0">Total</p></th>
                                            <th><p class="mb-0 text-center">{{ $totalQty }}</p></th>
                                            <th><p class="mb-0 text-center">{{ (int) $totalVolume }} CBM</p></th>
                                            <th><p class="mb-0 text-center">{{ number_format($totalWeight, 0, ',', '.') }} kg</p></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
               
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h5>Tracking Order</h5>
                                <i class="ti ti-map-pin text-danger ms-2 mb-2"></i>
                            </div>
                            @php
                                $maxCount = $tracking->count() - 1;
                                $count = 0;
                            @endphp
                            @foreach ($tracking as $item)
                            <div class="row">
                                <div class="col-2">
                                    @if ($count != 0)
                                    <small class="mb-1 text-muted">{{$item->created_at->format('d M Y H:i')}}</small>
                                    @else
                                    <small class="mb-1 fw-medium text-primary">{{$item->created_at->format('d M Y H:i')}}</small>
                                    @endif
                                </div>
                                <div class="col-1">
                                    @if ($count != 0)
                                    <div class="rounded-circle bg-secondary mx-auto" style="width: 16px; height: 16px;"></div>
                                    @else
                                    <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                    @endif
                                    @if ($count != $maxCount)
                                    <div class="bg-secondary mx-auto" style="width: 1px; height: 80px;"></div>
                                    @endif
                                    
                                </div>
                                <div class="col-6">
                                    @if ($count != 0)
                                    <p class="mb-1 text-muted">{{$item->description}}</p>
                                    @else
                                    <p class="mb-1 fw-medium text-primary">{{$item->description}}</p>
                                    @endif
    
                                    @if ($count != 0)
                                    <p class="mb-1 text-muted">{{$item->currentLocation}} ({{$item->currentVehicle}})</p>
                                    @else
                                    <p class="mb-1  text-primary">{{$item->currentLocation}} ({{$item->currentVehicle}})</p>
                                    @endif
                                </div>                            
                                <div class="col-3 text-end text-muted">
                                    <span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @php
                                $count++;
                            @endphp 
                            @endforeach
                        </div>
                    </div>
                </div>
                
                {{-- @php
                $count = 1
                @endphp
                @if ($userOrder->order->truck_first && $userOrder->order->truck_second)
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Detail Truck 1</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="border rounded p-3 bg-white text-center" style="max-width: 400px; margin: auto;">
                                        @if(!empty($userOrder->order->truck_first->picture))
                                            <img src="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                        @else
                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nama Penanggung Jawab</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->driverName }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nomor Telepon</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->driverContact }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Plat Nomor Truk</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->plateNumber }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Brand</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->brand }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tahun Produksi</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->yearBuilt }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tipe</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Detail Truck 2</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="border rounded p-3 bg-white text-center" style="max-width: 400px; margin: auto;">
                                        @if(!empty($userOrder->order->truck_second->picture))
                                            <img src="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                        @else
                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nama Penanggung Jawab</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->driverName }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nomor Telepon</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->driverContact }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Plat Nomor Truk</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->plateNumber }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Brand</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->brand }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tahun Produksi</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->yearBuilt }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tipe</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif ($userOrder->order->truck_first)
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Detail Truck {{$count}}</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="border rounded p-3 bg-white text-center" style="max-width: 400px; margin: auto;">
                                        @if(!empty($userOrder->order->truck_first->picture))
                                            <img src="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                        @else
                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nama Penanggung Jawab</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->driverName }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nomor Telepon</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->driverContact }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Plat Nomor Truk</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->plateNumber }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Brand</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->brand }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tahun Produksi</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->yearBuilt }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tipe</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_first->type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $count++
                @endphp
                @elseif ($userOrder->order->truck_second)
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Detail Truck {{$count}}</h5>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="border rounded p-3 bg-white text-center" style="max-width: 400px; margin: auto;">
                                        @if(!empty($userOrder->order->truck_second->picture))
                                            <img src="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                        @else
                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nama Penanggung Jawab</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->driverName }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Nomor Telepon</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->driverContact }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Plat Nomor Truk</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->plateNumber }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Brand</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->brand }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tahun Produksi</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->yearBuilt }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><p>Tipe</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->truck_second->type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Tidak ada detail truck</h5>
                        </div>
                    </div>
                </div>
                @endif --}}
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x: auto;"> 
                           <table class="table table-striped table-bordered nowrap" id="pc-dt-simple" style="min-width: 100px;">
                                <thead>
                                        <tr>
                                            <th><p class="mb-0 text-center">No</p></th>
                                            <th><p class="mb-0 text-center">Penanggung Jawab</p></th>
                                            <th><p class="mb-0 text-center">Nomor Telepon</p></th>
                                            <th style="width: 200px;"><p class="mb-0 text-center">Plat Nomor</p></th>
                                            <th><p class="mb-0 text-center">Brand</p></th>
                                            <th><p class="mb-0 text-center">Tahun Produksi</p></th>
                                            <th><p class="mb-0 text-center">Tipe</p></th>
                                            <th><p class="mb-0 text-center">Gambar</p></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($userOrder->order->truck_first && $userOrder->order->truck_second)
                                        <tr>
                                            <td><p class="mb-0 text-center">1</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->driverName}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->driverContact}}</p></td>
                                            <td style="width: 120px; min-width: 120px; max-width: 200px; white-space: nowrap;"><p class="mb-0 text-center">{{$userOrder->order->truck_first->plateNumber}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->brand}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->yearBuilt}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->type}}</p></td>
                                            <td>
                                                <p class="mb-0 text-center">
                                                    @if(!empty($userOrder->order->truck_first->picture))
                                                        <a href="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('images/truck-not-found.jpeg') }}" target="_blank">
                                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><p class="mb-0 text-center">2</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->driverName}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->driverContact}}</p></td>
                                            <td style="width: 120px; min-width: 120px; max-width: 200px; white-space: nowrap;"><p class="mb-0 text-center">{{$userOrder->order->truck_second->plateNumber}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->brand}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->yearBuilt}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->type}}</p></td>
                                            <td>
                                                <p class="mb-0 text-center">
                                                    @if(!empty($userOrder->order->truck_second->picture))
                                                        <a href="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('images/truck-not-found.jpeg') }}" target="_blank">
                                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @elseif ($userOrder->order->truck_first)
                                        <tr>
                                            <td><p class="mb-0 text-center">1</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->driverName}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->driverContact}}</p></td>
                                            <td style="width: 120px; min-width: 120px; max-width: 200px; white-space: nowrap;"><p class="mb-0 text-center">{{$userOrder->order->truck_first->plateNumber}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->brand}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->yearBuilt}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_first->type}}</p></td>
                                            <td>
                                                <p class="mb-0 text-center">
                                                    @if(!empty($userOrder->order->truck_first->picture))
                                                        <a href="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $userOrder->order->truck_first->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('images/truck-not-found.jpeg') }}" target="_blank">
                                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @elseif ($userOrder->order->truck_second)
                                        <tr>
                                            <td><p class="mb-0 text-center">1</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->driverName}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->driverContact}}</p></td>
                                            <td style="width: 120px; min-width: 120px; max-width: 200px; white-space: nowrap;"><p class="mb-0 text-center">{{$userOrder->order->truck_second->plateNumber}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->brand}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->yearBuilt}}</p></td>
                                            <td><p class="mb-0 text-center">{{$userOrder->order->truck_second->type}}</p></td>
                                            <td>
                                                <p class="mb-0 text-center">
                                                    @if(!empty($userOrder->order->truck_second->picture))
                                                        <a href="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" target="_blank">
                                                            <img src="{{ asset('storage/' . $userOrder->order->truck_second->photo) }}" alt="Foto Truck 1" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('images/truck-not-found.jpeg') }}" target="_blank">
                                                            <img src="{{ asset('images/truck-not-found.jpeg') }}" alt="Tidak ada gambar" class="img-fluid rounded" style="max-height: 180px;">
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h5>Detail Penyedia Jasa Logistik</h5>
                            <hr>
                            <div class="row">
                                <div class="col"><p>Nama</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->lsp->companyName }}</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col"><p>Email</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->lsp->email }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col"><p>Nomor Telepon</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->lsp->telpNumber }}</p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col"><p>Alamat Kantor</p></div>
                                <div class="col">
                                    <p class="text-primary">{{ $userOrder->order->lsp->address }}</p>
                                </div>
                            </div>
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
                        Apakah Anda yakin mengirim ulasan ini?
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
                document.getElementById('reviewAddForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const stars = document.querySelectorAll('.star-rating');
                const ratingInput = document.getElementById('ratingNumber');
        
                stars.forEach((star) => {
                    star.addEventListener('click', function () {
                        const rating = this.getAttribute('data-value');
                        ratingInput.value = rating;
        
                        // update UI warna bintang
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= rating) ? '#f39c12' : '#ccc';
                        });
                    });
        
                    // Tambahan hover effect (opsional)
                    star.addEventListener('mouseover', function () {
                        const hoverRating = this.getAttribute('data-value');
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= hoverRating) ? '#f39c12' : '#ccc';
                        });
                    });
        
                    star.addEventListener('mouseout', function () {
                        const currentRating = ratingInput.value;
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= currentRating) ? '#f39c12' : '#ccc';
                        });
                    });
                });
        
                // Inisialisasi jika sudah ada nilai sebelumnya
                const initRating = ratingInput.value;
                stars.forEach(s => {
                    s.style.color = (s.getAttribute('data-value') <= initRating) ? '#f39c12' : '#ccc';
                });
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
@endsection