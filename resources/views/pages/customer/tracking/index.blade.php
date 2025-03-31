@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Tracking Order')
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
                    <li class="breadcrumb-item" aria-current="page">Tracking Order</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12 col-md-6 col-xl-6">
            {{-- <div class="input-group mb-3">
                <span class="input-group-text"><i class="ti ti-search"></i></span>
                <input type="text" name="origin" class="form-control" placeholder="Cari nomor pelacakan..." value=""> 
            </div> --}}
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="" name="" placeholder="Cari nomor pelacakan..." value="">
                <span class="input-group-text bg-primary">
                  <i class="ti ti-search" style="cursor: pointer; color: white;"></i>
                </span>
            </div>
            @foreach ( $userOrder as $item)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 d-flex align-items-center">
                            <div class="me-4">
                                <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                    alt="profile-lsp" 
                                    class="user-avtar border wid-35 rounded-circle">
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $item->order->lspName }}</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            @if ($item['shipmentMode'] == 'laut')
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-sailboat me-1"></i> Laut
                                </button>   
                            @else
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-truck-delivery me-1"></i> Darat
                                </button>
                            @endif
                        </div>
                        <div class="col-4 d-flex align-items-center justify-content-end">
                            <h5 class="text-primary">ID: {{$item->order->noOffer}}</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-1 d-flex align-items-start justify-content-start">
                            Asal
                        </div>
                        <div class="col-1">
                            <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                            <div class="bg-primary mx-auto" style="width: 1px; height: 30px;"></div>
                        </div>
                        <div class="col-4">
                            <p><b>{{$item->order->origin}}</b></p>
                        </div>
                        <div class="col-6 d-flex align-items-start justify-content-end">
                            <button type="button" class="btn btn-success rounded-pill">
                                {{ $item->order->shipmentType == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 d-flex align-items-start justify-content-start">
                            Tujuan
                        </div>
                        <div class="col-1">
                            <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                        </div>
                        <div class="col-4">
                            <p><b>{{$item->order->destination}}</b></p>
                        </div>
                        <div class="col-6 d-flex align-items-start justify-content-end">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 d-flex align-items-center justify-content-start">
                            Etimasi
                        </div>
                        <div class="col-1"></div>
                        <div class="col-4 d-flex align-items-center justify-content-start">
                            <p class="text-primary">{{$item->order->estimation_date_formatted}}</p>
                        </div>
                        <div class="col-6 d-flex align-items-start justify-content-end">
                            <button type="button" class="btn btn-primary d-inline-flex">Lihat detail <i class="ti ti-chevron-right ms-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>  
            @endforeach  
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4>Live Track</h4>
                    <i class="ti ti-map-pin text-danger"></i>
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