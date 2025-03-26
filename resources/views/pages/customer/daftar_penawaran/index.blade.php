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
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
                @foreach ($bids as $item )
                <div class="card card-hover">
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
                                    {{-- <div class="rounded-circle border border-2 border-primary" style="width: 16px; height: 16px;"></div> --}}
                                    <i class="ti ti-clock mx text-primary"></i> <h5 class="mb-0 mx-2 text-primary">{{ $item['estimated_days']}} Hari</h5> 
                                    {{-- <div class="rounded-circle border border-2 border-primary" style="width: 16px; height: 16px;"></div>     --}}
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
                                {{-- @if ($item['shipmentType'=='LCL'])
                                <div class="d-flex align-items-center justify-content-end mb-2">
                                    <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                                    <h5 class="mb-0 ms-2">/CBM</h5>
                                </div>
                                @else
                                <div class="d-flex align-items-center justify-content-end mb-2">
                                    <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                                </div>
                                @endif --}}
                                <a href="/list-offer/{{$item['id']}}" class="btn btn-primary w-50">Pilih</a>
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
