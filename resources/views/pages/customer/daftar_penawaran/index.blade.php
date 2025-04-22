@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Daftar Penawaran')
@section('content')
<div class="pc-container">
    <div class="pc-content">
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
                            <li class="breadcrumb-item" aria-current="page">Daftar Penawaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if ($bids->isEmpty())
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-5 col-xl-5">
                <h3 class="">Daftar Penawaran</h3>
            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-xl-10">
                <h3 class="">Daftar Penawaran</h3>
            </div>
        </div>
        @endif
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-10 col-xl-10">
                @if ($bids->isEmpty())
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="card text-center p-4 w-50">
                        <div class="card-body">
                            <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                            <h3 class="mb-2">Tidak Ada Penawaran</h3>
                            <p class="text-muted">Buat permintaan rute pengiriman baru</p>
                            <a href="/request-routes" class="btn btn-primary w-50">Buat Permintaan</a>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($bids as $item )
                {{-- <div class="card card-hover">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="me-2">
                                    <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}"  
                                        alt="profile-lsp" 
                                        class="user-avtar wid-35 rounded-circle">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0 fw-bold">{{ $item['lspName']}}</h5>
                                    <i class="fas fa-star text-warning"></i>
                                    <h5 class="mb-0 fw-bold">5.0</h5>
                                </div>
                            </div>
                
                            <div class="col-md-4 d-flex justify-content-center gap-2">
                                @if ($item['shipmentMode'] == 'laut')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-sailboat me-1"></i> Laut
                                    </button>   
                                @else
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Darat
                                    </button>
                                @endif

                                @if ($item['shipmentType'] == 'LCL')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-box me-1"></i> LCL
                                    </button> 
                                @else
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-box me-1"></i> FCL
                                    </button> 
                                @endif
                            
                                                                        
                            </div>
                
                            <div class="col-md-2 text-end">
                                <button type="button" class="btn btn-icon btn-light-primary">
                                    <i class="ti ti-copy"></i>
                                </button>
                            </div>
                        </div> 

                        <br>            
                
                        <div class="row align-items-center">
                            <div class="col-md-8 d-flex align-items-center justify-content-start mt-2">
                                <h5 class="mb-0 fw-bold">{{ $item['origin']}}</h5>                      
                                <div class="d-flex align-items-center mx-4">
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <i class="ti ti-clock mx text-primary"></i> <h5 class="mb-0 mx-2 text-primary">{{ $item['estimated_days']}} Hari</h5> 
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                </div>
                                <h5 class="mb-0 fw-bold">{{ $item['destination']}}</h5>
                            </div>

                            <div class="col-md-4 text-end mt-2">
                                <div class="d-flex align-items-center justify-content-end mb-2">
                                    <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                                    <h5 class="mb-0 ms-2">/CBM</h5>
                                </div>
                                <a href="/list-offer/{{$item['id']}}" class="btn btn-primary w-50">Pilih</a>
                            </div>
                        </div>                      
                    </div>
                </div>  --}}
                <div class="card card-hover mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <div class="me-4">
                                    <a href="/profile/lsp/{{ $item->user->id }}" class="">
                                        <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                            alt="profile-lsp" 
                                            class="user-avtar border wid-35 rounded-circle" 
                                            style="object-fit: cover; width: 35px; height: 35px;">
                                    </a>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0 fw-bold">{{ $item->lspName }}</h5>
                                    <i class="fas fa-star text-warning ms-2"></i>
                                    <h5 class="mb-0 fw-bold">{{$item->user->rating}}</h5>
                                </div>
                            </div>
                            <div class="col-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
                                @if ($item->shipmentMode == 'D2D')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Door to Door
                                    </button>   
                                @elseif( $item->shipmentMode == 'D2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Door to Port
                                    </button>
                                @elseif( $item->shipmentMode == 'P2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-sailboat me-1"></i> Port to Port
                                    </button>
                                @elseif( $item->shipmentMode == 'P2D')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Port to Door
                                    </button>
                                @endif
                                @if ($item['shipmentType'] == 'LCL')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-box me-1"></i> LCL
                                    </button> 
                                @else
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-box me-1"></i> FCL
                                    </button> 
                                @endif
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end">
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-1 d-flex align-items-start justify-content-start">
                                <p style="font-weight: normal;">Asal</p>
                            </div>
                            <div class="col-1">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                                <div class="bg-primary mx-auto" style="width: 1px; height: 50px;"></div>
                            </div>
                            <div class="col-2">
                                <p class="fw-bold text-primary">{{$item->origin}}</p>
                            </div>
                            <div class="col-2">
                                <p style="font-weight: normal;">Tanggal Pengiriman</p>
                            </div>
                            <div class="col-3">
                                <p class="fw-bold text-primary">{{$item->shipping_date_formatted}}</p>
                            </div>
                            <div class="col-3 d-flex align-items-start justify-content-end ">
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                                <p class="mb-0 ms-2 mt-1">/Container</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 d-flex align-items-start justify-content-start">
                                <p style="font-weight: normal;">Tujuan</p>
                            </div>
                            <div class="col-1">
                                <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                            </div>
                            <div class="col-2">
                                <p class="fw-bold text-primary">{{$item->destination}}</p>
                            </div>
                            <div class="col-2">
                                <p class="mb-0" style="font-weight: normal;">Estimasi Tiba</p>
                            </div>
                            <div class="col-3">
                                <p class="fw-bold text-primary">{{$item->estimation_date_formatted}}</p>
                            </div>
                            <div class="col-3 d-flex align-items-start justify-content-end">
                                <a href="/list-offer/{{$item['id']}}" class="btn btn-primary w-50 w-md-50">Lihat detail<i class="ti ti-chevron-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach           
            </div>
        </div>
    </div>
</div>
@endsection
