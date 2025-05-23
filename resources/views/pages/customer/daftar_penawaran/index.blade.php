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
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-xl-12">
                <h4 class="">Daftar Penawaran</h4>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-12 col-xl-12">
                
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Filter</b>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="/list-offer">Clear</a>
                                    </div>
                                </div>
                                <br>
                                <form action="{{ route('list-offer') }}">
                                <div class="row">
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" id="btnrdo1" name="btn_radio1" value="Murah" {{ request('btn_radio1') == 'Murah' ? 'checked' : '' }}> 
                                        <label class="btn btn-outline-primary" for="btnrdo1">Murah</label> 
            
                                        <input type="radio" class="btn-check" id="btnrdo3" name="btn_radio1" value="Cepat" {{ request('btn_radio1') == 'Cepat' ? 'checked' : '' }}> 
                                        <label class="btn btn-outline-primary" for="btnrdo3">Cepat</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
            
                                <p class="fw-bold">Harga Maksimal</p>
                                <input type="number" name="maxPrice" class="form-control" placeholder="Rp." value="{{ request('maxPrice') }}">
                                <hr>
            
                                <p class="fw-bold">Waktu Maksimal</p>
                                <input type="number" name="maxTime" class="form-control" placeholder="Rp." value="{{ request('maxTime') }}">
                                <hr>
            
                                <div class="row ">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @if ($bids->isEmpty())
                    <div class="col-9">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <div class="card text-center p-4 w-100">
                                <div class="card-body">
                                    <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                                    <h3 class="mb-2">Tidak Ada Penawaran</h3>
                                    <p class="text-muted">Buat permintaan rute pengiriman baru</p>
                                    <a href="/request-routes" class="btn btn-primary w-50">Buat Permintaan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @foreach ($bids as $item )
                        <div class="col-9">
                            <div class="card card-hover mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="me-4">
                                                <a href="/profile/lsp/{{ $item->user->id }}" class="">
                                                    <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                                        alt="profile-lsp" 
                                                        class="user-avtar border wid-35 rounded-circle" 
                                                        style="object-fit: cover; width: 25px; height: 25px;">
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-0 fw-bold">{{ $item->lspName }}</p>
                                                <i class="fas fa-star text-warning ms-2"></i>
                                                <p class="mb-0 fw-bold">{{$item->user->rating}}</p>
                                            </div>
                                        </div>
                                        <div class="col-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
                                            @if ($item->shipmentMode == 'D2D')
                                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                                    <i class="ti ti-truck-delivery me-1"></i> Door To Door
                                                </button>   
                                            @elseif( $item->shipmentMode == 'D2P')
                                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                                    <i class="ti ti-truck-delivery me-1"></i> Door To Port
                                                </button>
                                            @elseif( $item->shipmentMode == 'P2P')
                                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                                    <i class="ti ti-sailboat me-1"></i> Port To Port
                                                </button>
                                            @elseif( $item->shipmentMode == 'P2D')
                                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                                    <i class="ti ti-truck-delivery me-1"></i> Port To Door
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
                                        <div class="col-3 d-flex flex-column align-items-end">
                                            <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                                            <p class="mb-0 ms-sm-2 mt-sm-1 p">/Container</p>
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
                                            <a href="/list-offer/{{$item['id']}}" class="btn btn-primary w-50 w-md-50">Pilih</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>           
            </div>
        </div>
    </div>
</div>
@endsection
