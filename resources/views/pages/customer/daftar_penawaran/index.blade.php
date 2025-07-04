@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Bidding List')
@section('content')
 <!-- [ Main Content ] start -->
 <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-xl-12">
              <div class="page-header-title">
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Bidding List</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12 col-md-12 col-xl-12">
        <h4 class="m-b-10">Bidding List</h4>
          

      <div class="row">
        
        {{-- Kotak filter --}}
        
        <div class="col-sm-12 col-md-3 col-xl-3" style="position: sticky; top: 80px; height: fit-content;">
            <div class="card">
                <form action="{{ route('list-offer') }}">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <b>Filter</b>
                        </div>
                        <div class="col-6 text-end">
                            <a href="/search-routes">Clear</a>
                        </div>
                    </div>
                    <br>

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
                    <input type="number" name="maxTime" class="form-control" placeholder="Hari" value="{{ request('maxTime') }}">
                    <hr>

                    <div class="row ">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
{{-- End Kotak filter --}}

{{-- Card Offer --}}
        <div class="col-sm-12 col-md-9 col-xl-9">
            @if($offers->isEmpty())
                <div class="card text-center p-4">
                    <div class="card-body">
                        <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                        <h3 class="mb-2">Cari untuk memulai!</h3>
                        <p class="text-muted">Masukkan kota asal dan tujuan untuk memulai pencarian.</p>
                    </div>
                </div> 
            @else
                @foreach ($offers as $item )
                {{-- <div class="card card-hover mb-3">
                    <div class="card-body">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                                <div class="me-4">
                                    <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                        alt="profile-lsp" 
                                        class="user-avtar wid-35 rounded-circle">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0 fw-bold">{{ $item['lspName']}}</h5>
                                    <i class="fas fa-star text-warning ms-2"></i>
                                    <h5 class="mb-0 fw-bold">{{$item->user->rating}}</h5>
                                </div>
                            </div>
                
                            <div class="col-12 col-md-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
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
                            
                            <div class="col-12 col-md-2 d-none d-md-block text-center text-md-end mt-2 mt-md-0">
                                <button type="button" class="btn btn-icon btn-light-primary">
                                    <i class="ti ti-copy"></i>
                                </button>
                            </div>                            
                        </div>
                
                        <br>            
                
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md-8 d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start mt-2">
                                <h5 class="mb-0 fw-bold">{{ $item['origin']}}</h5>                      
                                
                                <!-- Garis dan ikon hanya muncul di layar medium ke atas -->
                                <div class="d-none d-md-flex align-items-center mx-4">
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <i class="ti ti-clock mx text-primary"></i> 
                                    <h5 class="mb-0 mx-2 text-primary">{{ $item['estimated_days']}} Hari</h5> 
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                </div>
                        
                                <!-- Estimasi tetap terlihat di layar kecil tanpa garis -->
                                <div class="d-block d-md-none mt-1">
                                    <i class="ti ti-clock text-primary"></i> 
                                    <h5 class="mb-0 text-primary">{{ $item['estimated_days']}} Hari</h5> 
                                </div>
                        
                                <h5 class="mb-0 fw-bold">{{ $item['destination']}}</h5>
                            </div>
                        
                            <div class="col-12 col-md-4 text-center text-md-end mt-2">
                                <div class="d-flex align-items-center justify-content-center justify-content-md-end mb-2">
                                    <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                                    <h5 class="mb-0 ms-2">/CBM</h5>
                                </div>
                                <a href="/search-routes/{{$item['id']}}" class="btn btn-primary w-75 w-md-50">Pilih</a>
                            </div>
                        </div> 
                                             
                    </div>
                </div>                  --}}
                <div class="card card-hover mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <a href="/profile/lsp/{{ $item->user->id }}" class="me-4">
                                    <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                        alt="profile-lsp" 
                                        class="user-avtar border wid-35 rounded-circle" 
                                        style="object-fit: cover; width: 25px; height: 25px;">
                                </a>
                                <div class="d-flex align-items-center gap-2">
                                    <p class="mb-0 fw-bold">{{ $item->user->companyName }}</p>
                                    <i class="fas fa-star text-warning ms-2"></i>
                                    <p class="mb-0 fw-bold">{{$item->user->rating}}</p>
                                </div>
                            </div>
                            <div class="col-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
                                {{-- @if ($item['shipmentMode'] == 'D2D')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> D2D
                                    </button>   
                                @elseif( $item['shipmentMode'] == 'D2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> D2P
                                    </button>
                                @elseif( $item['shipmentMode'] == 'P2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-sailboat me-1"></i> P2P
                                    </button>
                                @elseif( $item['shipmentMode'] == 'P2D')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> P2D
                                    </button>
                                @endif --}}
                                @if ($item['transportationMode'] == 'darat')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Darat
                                    </button>   
                                @elseif( $item['transportationMode'] == 'laut')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti ti-ship me-1"></i> Laut
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
                                {{-- <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-box me-1"></i> 20' Container
                                </button>  --}}
                                {{-- <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-box me-1"></i> General Cargo
                                </button>  --}}
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end">
                                @if ($item->remainingVolume > ($item->maxVolume * 0.5))
                                    <button type="button" class="btn btn-success d-inline-flex rounded-pill"><span class="me-2 fw-bold"> {{ $item->remainingVolume }}</span>CBM tersedia</button>
                                @elseif ($item->remainingVolume <= ($item->maxVolume * 0.5 && $item->remainingVolume > ($item->maxVolume * 0.2)))
                                    <button type="button" class="btn btn-warning rounded-pill"><span class="me-2 fw-bold"> {{ $item->remainingVolume }}</span>CBM tersedia</button>
                                @elseif ($item->remainingVolume <= ($item->maxVolume * 0.2))
                                    <button type="button" class="btn btn-danger rounded-pill"><span class="me-2 fw-bold"> {{ $item->remainingVolume }}</span>CBM tersedia</button>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-1 d-flex align-items-start justify-content-start">
                                <p style="font-weight: normal;">Asal</p>
                            </div>
                            <div class="col-3">
                                <p class="text-primary">{{$item->origin}}</p>
                            </div>
                             <div class="col-1 d-flex align-items-start justify-content-start">
                                <p style="font-weight: normal;">Tujuan</p>
                            </div>
                            <div class="col-3">
                                <p class="text-primary">{{$item->destination}}</p>
                            </div>
                            
                            <div class="col-4 d-flex flex-column flex-sm-row align-items-start justify-content-end">
                                @if ($item['shipmentType'] == 'FCL')
                                    <div class="d-flex flex-column align-items-end">
                                        <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                                        <p class="mb-0 ms-sm-2 mt-sm-1 p">/Container</p>
                                    </div>
                                @else
                                    <div class="d-flex flex-column align-items-end">
                                        <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                                        <p class="mb-0 ms-sm-2 mt-sm-1 p">/CBM</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="row">
                           <div class="col-1">
                                <p style="font-weight: normal;">ETD</p>
                            </div>
                            <div class="col-3">
                                @if (!empty($item->departureDate))
                                    <p class="text-primary">{{$item->getdeparturedate()}}</p>
                                @else
                                    <p class="text-primary">{{$item->getETD()}}</p>
                                @endif
                            </div>
                            <div class="col-1">
                                <p class="mb-0" style="font-weight: normal;">ETA</p>
                            </div>
                            <div class="col-3">
                                @if (!empty($item->arrivalDate))
                                    <p class="text-primary">{{$item->getarrivaldate()}}</p>
                                @else
                                    <p class="text-primary">{{$item->geteta()}}</p>
                                @endif
                            </div>
                            <div class="col-4 text-end">
                                <a href="/list-offer/{{$item['id']}}" class="btn btn-primary w-50 w-md-50"><span class="mb-2">Pilih</span></a>
                            </div>
                        </div>
                    </div>
                </div>  
                @endforeach               
            @endif
                </div>
            </div>
        </div>
{{-- End Card Offer --}}
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