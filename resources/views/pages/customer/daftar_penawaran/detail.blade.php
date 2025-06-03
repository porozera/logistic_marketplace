@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Detail Offer')
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
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Bidding List</a></li>
                    <li class="breadcrumb-item" aria-current="page">Detail Offer</li>
                </ul>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
            {{-- <h4 class="m-b-10 text-primary">{{ $offer['noOffer'] }}</h4> --}}
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="me-2">
                                <a href="/profile/lsp/{{ $offer->user->id }}" class="me-2">
                                    <img src="{{ $offer->user->profilePicture ? asset('storage/' . $offer->user->profilePicture) : asset('default-profile.jpg') }}" 
                                        alt="profile-lsp" 
                                        class="user-avtar border wid-35 rounded-circle" 
                                        style="object-fit: cover; width: 35px; height: 35px;">
                                </a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold">{{ $offer->user->companyName}}</h5>
                                <i class="fas fa-star text-warning"></i>
                                <h5 class="mb-0 fw-bold">5.0</h5>
                            </div>
                        </div>
            
                        <div class="col-md-4 d-flex justify-content-center gap-2">
                            {{-- @if ($offer['shipmentMode'] == 'laut')
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-sailboat me-1"></i> Laut
                                </button>   
                            @else
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-truck-delivery me-1"></i> Darat
                                </button>
                            @endif

                            @if ($offer['shipmentType'] == 'LCL')
                                <button type="button" class="btn btn-success d-flex align-items-center rounded-pill">
                                    <i class="ti ti-box me-1"></i> LCL
                                </button> 
                            @else
                                <button type="button" class="btn btn-success d-flex align-items-center rounded-pill">
                                    <i class="ti ti-box me-1"></i> FCL
                                </button> 
                            @endif --}}
                        
                                                                    
                        </div>
                    </div>    
            
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center justify-content-start mt-2">
                            <p class="mb-0 fw-bold">{{ $offer['origin']}}</p>                      
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 10px; height: 10px;"></div>
                                <div class="bg-primary mx-2" style="width: 50px; height: 1px;"></div>
                                {{-- <i class="ti ti-clock mx text-primary"></i>  --}}
                                <p class="mb-0 mx-2 text-primary">{{ $offer['estimated_days']}} Hari</p> 
                                <div class="bg-primary mx-2" style="width: 50px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 10px; height: 10px;"></div>
                            </div>
                            <p class="mb-0 fw-bold">{{ $offer['destination']}}</p>
                        </div>

                        <div class="col-md-4 text-end mt-2">
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                @if ($offer['shipmentType'] == 'FCL')
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($offer['price']*$offer['maxVolume'], 0, ',', '.')}}</h4>
                                <p class="mb-0 ms-2">/Container</p>
                                @else
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($offer['price'], 0, ',', '.')}}</h4>
                                <p class="mb-0 ms-2">/CBM</p>
                                @endif
                            </div>
                            <a href="/list-offer/order/{{$offer['id']}}" class="btn btn-primary w-50">Pesan Sekarang</a>
                        </div>
                    </div>                      
                </div>
                </div> 
            </div> 
        </div>

        <div class="row">
            <!-- Detail Penawaran -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Detail Penawaran</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Penyedia Jasa Logistik</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-primary d-inline">{{ $offer->user->companyName }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>No Offer</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary d-inline">{{ $offer['noOffer'] }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">Jalur Pengiriman</div>
                            <div class="col-md-6">
                                {{-- <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1 text-primary"></i> --}}
                                @if ($offer['transportationMode'] == 'darat')
                                <i class="ti ti-truck-delivery text-primary me-1"></i> <span class="text-primary">Darat</span>    
                                @elseif ($offer['transportationMode'] == 'laut')
                                <i class="ti ti-sailboat text-primary me-1"></i> <span class="text-primary">Laut</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Mode Pengiriman</div>
                            <div class="col-md-6">
                                {{-- <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1 text-primary"></i> --}}
                                @if ($offer['shipmentMode'] == 'D2D')
                                <p class="text-primary">Door To Door</p>  
                                @elseif ($offer['shipmentMode'] == 'D2P')
                                <p class="text-primary">Door To Port</p>
                                @elseif ($offer['shipmentMode'] == 'P2D')
                                <p class="text-primary">Port To Door </p>  
                                @elseif ($offer['shipmentMode'] == 'P2P')
                                <p class="text-primary">Port To Port</p>
                                @endif
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <div class="col-md-6">Tipe Pengiriman</div>
                            <div class="col-md-6">
                                @if ($offer['shipmentType'] == 'FCL')
                                    <span class="text-primary">FCL</span>
                                @else
                                    <span class="text-primary">LCL</span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <p>Asal Pengiriman</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $offer['origin'] }}</p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tujuan Pengiriman</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $offer['destination'] }}</p>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <p>Alamat Tujuan</p> 
                            <span class="text-primary">{{ optional($order)->address ?? '-' }}</span>
                        </div>
        
        
                        <hr>
        
                        <h4 class="mb-3">Detail Kontainer</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tipe Kontainer</p>
                            </div>
                            <div class="col-md-6">
                                @if ($offer->container)
                                    <span class="text-primary">{{ $offer->container->name }}</span>
                                @else
                                    <span class="text-muted text-primary">Tidak ada detail kontainer</span>
                                @endif
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Sisa Kapasitas Berat</p> 
                            </div>
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">{{ $offer['remainingWeight'] }}</span> / {{ $offer['maxWeight'] }} kg
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-md-6">
                                <p>Sisa Kapasitas Volume</p> 
                            </div>
                            <div class="col-md-6">
                                <span class="text-danger fw-bold">{{ $offer['remainingVolume'] }}</span> / {{ $offer['maxVolume'] }} CBM
                            </div>
                            
                        </div>
        
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tipe Barang</p>
                            </div>
                            <div class="col-md-6">
                                <span class="text-primary">{{ $offer['cargoType'] }}</span>
                            </div>  
                        </div>
                    </div>
                </div>
                <!-- Daftar Layanan -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="mb-3">Daftar Layanan</h4>
                        @foreach ($services as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item['serviceName'] }}" id="flexCheckDefault" checked>
                                <i class="{{$item->icon}} me-1"></i>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item['serviceName'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
        
            <!-- Detail Rute -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Detail Rute</h4>
                        @if ($offer->shipmentMode == "D2D" && $offer->transportationMode == "laut") 
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">Kota Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Tanggal Muat Barang</p>
                                    <p class="text-sm mb-0">{{ $offer->getpickupDate() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Truck</p>
                                @if ($offer->truck_first != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_first->type}}</p>
                                @elseif ($offer->truck_first == null && $offer->truck_second != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_second->type}}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada informasi truk</p>
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                {{-- <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Tanggal Pengiriman</p>
                                    <p class="text-sm mb-0">{{ $offer['shipping_date_formatted'] }}</p>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['portOrigin'] }}</p>
                                <p class="text-sm text-gray-500">Pelabuhan Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">CY Closing Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getcyclosingDate() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-ship text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Kapal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Estimated Time Departure</p>
                                    <p class="text-sm mb-0">{{ $offer->getETD() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['portDestination'] }}</p>
                                <p class="text-sm text-gray-500">Pelabuhan Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Arrival</p>
                                    <p class="text-sm mb-0">{{ $offer->getETA() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Truck</p>
                                @if ($offer->truck_second != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_second->type}}</p>
                                @elseif ($offer->truck_second == null && $offer->truck_first != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_first->type}}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada informasi</p>
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Delivery Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getdeliveryDate() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">Kota Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Arrival Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getarrivalDate() }}</p>
                                </div>
                            </div>
                        </div>

                        @elseif ($offer->shipmentMode == "D2D" && $offer->transportationMode == "darat") 
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">Kota Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Tanggal Muat Barang</p>
                                    <p class="text-sm mb-0">{{ $offer->getpickupDate() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Truck</p>
                                @if ($offer->truck_first != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_first->type}}</p>
                                @elseif ($offer->truck_first == null && $offer->truck_second != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_second->type}}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada informasi truk</p>
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Departure</p>
                                    <p class="text-sm mb-0">{{ $offer->getETD() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">Kota Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded bg-teal-100">
                                    <p class="font-semibold mb-1 text-teal-700">Estimated Time Arrival</p>
                                    <p class="text-sm mb-0">{{ $offer->getarrivalDate() }}</p>
                                </div>
                            </div>
                        </div>

                        @elseif ($offer->shipmentMode == "P2P")
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">{{ $offer['portOrigin'] }}</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">CY Closing Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getcyclosingdate() }}</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-ship text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Kapal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Departure</p>
                                    <p class="text-sm mb-0">{{ $offer->getETD() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">{{ $offer['portDestination'] }}</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Estimated Time Arrival</p>
                                    <p class="text-sm mb-0">{{ $offer->getETA() }}</p>
                                </div>
                            </div>
                        </div>

                        @elseif ($offer->shipmentMode == "D2P")
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">Kota Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Tanggal Muat Barang</p>
                                    <p class="text-sm mb-0">{{ $offer->getpickupDate() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-truck-delivery text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Truck</p>
                                @if ($offer->truck_first)
                                    <p class="text-sm text-gray-500">{{ $offer->truck_first->type }}</p>
                                @elseif ($offer->truck_second)
                                    <p class="text-sm text-gray-500">{{ $offer->truck_second->type }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada informasi truk</p>
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                {{-- <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Tanggal Pengiriman</p>
                                    <p class="text-sm mb-0">{{ $offer['shipping_date_formatted'] }}</p>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['portOrigin'] }}</p>
                                <p class="text-sm text-gray-500">Pelabuhan Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">CY Closing Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getcyclosingDate() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-ship text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Kapal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Estimated Time Departure</p>
                                    <p class="text-sm mb-0">{{ $offer->getETD()}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">Pelabuhan Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Arrival</p>
                                    <p class="text-sm mb-0">{{ $offer->getETA() }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row mt-3 mb-0 pb-0">
                            <div class="col-12">
                                <p class="text-sm text-gray-700" style="margin-bottom: 0;">*Jika pengiriman dilakukan dalam satu kota yang sama, pengiriman menggunakan kapal tidak diperlukan. </p>
                            </div>
                        </div> --}}

                        @elseif ($offer->shipmentMode == "P2D")
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">{{ $offer['portOrigin'] }}</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">CY Closing Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getcyclosingDate() }}</p>
                                </div>
                            </div>
                        </div>
        
                         <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-ship text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Kapal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Departure</p>
                                    <p class="text-sm mb-0">{{ $offer->getETD()}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-anchor text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['portDestination'] }}</p>
                                <p class="text-sm text-gray-500">Pelabuhan Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Estimated Time Arrival</p>
                                    <p class="text-sm mb-0">{{ $offer->getETA() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} text-primary"></i>
                                <p class="mb-0 fw-medium">Pengiriman Truck</p>
                                @if ($offer->truck_second != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_second->type}}</p>
                                @elseif ($offer->truck_second == null && $offer->truck_first != null)
                                    <p class="text-sm text-gray-500">{{$offer->truck_first->type}}</p>
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada informasi</p>
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Delivery Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getdeliveryDate() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">Kota Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Arrival Date</p>
                                    <p class="text-sm mb-0">{{ $offer->getarrivalDate() }}</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['origin'] }}</p>
                                <p class="text-sm text-gray-500">Kota Asal</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Tanggal Muat Barang</p>
                                    <p class="text-sm mb-0">{{ $offer['loading_date_formatted'] }}</p>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['shipmentMode'] == 'laut' ? 'Pengiriman Kapal' : 'Pengiriman Truk' }}</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle border border-2 border-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 100px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="p-3 rounded border">
                                    <p class="font-semibold mb-1">Tanggal Pengiriman</p>
                                    <p class="text-sm mb-0">{{ $offer['shipping_date_formatted'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5 text-end">
                                <i class="ti ti-building-warehouse text-primary"></i>
                                <p class="mb-0 fw-medium">{{ $offer['destination'] }}</p>
                                <p class="text-sm text-gray-500">Kota Tujuan</p>
                            </div>
                            <div class="col-2 text-center">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                            </div>
                            <div class="col-5">
                                <div class="bg-teal-100 p-3 rounded">
                                    <p class="font-semibold text-teal-700 mb-1">Estimasi Arrival Date</p>
                                    <p class="text-sm mb-0">{{ $offer['estimation_date_formatted'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                {{-- disini tempat daftar layanan lama --}}
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
                        Apakah anda yakin menambah data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Save Changes</button>
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