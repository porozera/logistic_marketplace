@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Cari Rute')
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
                    <li class="breadcrumb-item" aria-current="page">Cari Rute</li>
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
        <h3 class="m-b-10">Cari Rute</h3>
          <div class="card">
            <div class="card-body">
                <form action="{{ route('search-route') }}">
                    <div class="row mb-0 mt-0">
                        <div class="col-sm-12 col-md-3">
                            <input type="text" name="origin" class="form-control" placeholder="Kota Asal" value="{{ request('origin') }}">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="text" name="destination" class="form-control" placeholder="Kota Tujuan" value="{{ request('destination') }}">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="date" name="shippingDate" class="form-control" placeholder="Tanggal Pengiriman" value="{{ request('shippingDate') }}">
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <select class="form-control" name="shipmentType" id="shipmentType">
                                <option value="FCL" {{ request('shipmentType') == 'FCL' ? 'selected' : '' }}>Full Container Load</option>
                                <option value="LCL" {{ request('shipmentType') == 'LCL' ? 'selected' : '' }}>Less Container Load</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-1">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        
        {{-- Kotak filter --}}
        <div class="col-sm-12 col-md-3 col-xl-3" style="position: sticky; top: 80px; height: fit-content;">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <b>Filter</b>
                        </div>
                        <div class="col-6 text-end">
                            Clear
                        </div>
                    </div>
                    <br>
                    <form action="{{ route('search-route') }}">
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
                    {{-- <h5>Layanan</h5>
                    @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="insurance" id="insurance" {{ request('insurance') ? 'checked' : '' }}>
                        <i class="{{$service->icon}} me-1"></i>
                        <label class="form-check-label" for="insurance">
                          {{$service->serviceName}}
                        </label>
                    </div>
                    @endforeach --}}
                    <h5>Jenis Barang</h5>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="category[]"
                                id="category-{{ Str::slug($category) }}"
                                value="{{ $category }}"
                                {{ in_array($category, (array) request('category')) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="category-{{ Str::slug($category) }}">
                                {{ $category }}
                            </label>
                        </div>
                    @endforeach

                    <hr>

                    <h5>Jenis Kontainer</h5>
                    @foreach ($containers as $container)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="category[]"
                                id="category-{{ Str::slug($container) }}"
                                value="{{ $container }}"
                                {{ in_array($container, (array) request('container')) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="container-{{ Str::slug($container) }}">
                                {{ $container }}
                            </label>
                        </div>
                    @endforeach

                    <hr>

                    <h5>Harga Maksimal</h5>
                    <input type="number" name="maxPrice" class="form-control" placeholder="Rp." value="{{ request('maxPrice') }}">
                    <hr>

                    <h5>Waktu Maksimal</h5>
                    <input type="number" name="maxTime" class="form-control" placeholder="Rp." value="{{ request('maxTime') }}">
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
            @if(!$searchPerformed)
                <div class="card text-center p-4">
                    <div class="card-body">
                        <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                        <h3 class="mb-2">Cari untuk memulai!</h3>
                        <p class="text-muted">Masukkan kota asal dan tujuan untuk memulai pencarian.</p>
                    </div>
                </div> 
            @elseif ($offers->isEmpty())
                <div class="card text-center p-4">
                    <div class="card-body">
                        <img src="{{ asset('template/mantis/dist/assets/images/unavailable_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                        <h3 class="mb-2">Rute tidak tersedia</h3>
                        <p class="text-muted">Buat permintaan rute pengiriman baru</p>
                        <a href="/request-routes" class="btn btn-primary w-50">Buat Permintaan</a>
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
                                        style="object-fit: cover; width: 35px; height: 35px;">
                                </a>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0 fw-bold">{{ $item->user->companyName }}</h5>
                                    <i class="fas fa-star text-warning ms-2"></i>
                                    <h5 class="mb-0 fw-bold">{{$item->user->rating}}</h5>
                                </div>
                            </div>
                            <div class="col-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
                                @if ($item['shipmentMode'] == 'D2D')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Door To Door
                                    </button>   
                                @elseif( $item['shipmentMode'] == 'D2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-truck-delivery me-1"></i> Door To Port
                                    </button>
                                @elseif( $item['shipmentMode'] == 'P2P')
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                        <i class="ti ti-sailboat me-1"></i> Port To Port
                                    </button>
                                @elseif( $item['shipmentMode'] == 'P2D')
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
                                <p class="text-primary fw-bold">{{$item->loading_date_formatted}}</p>
                            </div>
                            <div class="col-3 d-flex align-items-start justify-content-end ">
                                @if ($item['shipmentType'] == 'FCL')
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                                <p class="mb-0 ms-2 mt-1">/Container</p>
                                @else
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                                <p class="mb-0 ms-2 mt-1">/CBM</p>
                                @endif
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
                                <p class="text-primary fw-bold">{{$item->estimation_date_formatted}}</p>
                            </div>
                            <div class="col-3 d-flex align-items-start justify-content-end">
                                <a href="/search-routes/{{$item['id']}}" class="btn btn-primary w-50 w-md-50">Lihat detail<i class="ti ti-chevron-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>  
                @endforeach               
            @endif

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