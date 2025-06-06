@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Order Form')
@section('style')
<style>
.container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(30px, 1fr)); /* otomatis menyesuaikan lebar */
    gap: 5px;
    padding: 10px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    justify-items: center;
    align-items: center;
}

.box {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    border-radius: 5px;
    flex-shrink: 0;
}

.available {
    background-color: green;
    color: white;
}

.booked {
    background-color: red;
    color: white;
}


</style>
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
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Search Routes</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Offer</a></li>
                  <li class="breadcrumb-item" aria-current="page">Order Form</li>
                </ul>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
          {{-- <h4 class="m-b-10">Detail Order</h4> --}}
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
                          {{-- @if ($offer->shipmentMode == 'D2D')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> D2D
                              </button>   
                          @elseif( $offer->shipmentMode == 'D2P')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> D2P
                              </button>
                          @elseif( $offer->shipmentMode == 'P2P')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-sailboat me-1"></i> P2P
                              </button>
                          @elseif( $offer->shipmentMode == 'P2D')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> P2D
                              </button>
                          @endif

                            <button type="button" class="btn btn-success rounded-pill">
                              {{ $offer['shipmentType'] == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                            </button> --}}
                        
                                                                    
                        </div>
            
                        <div class="col-md-2 text-end">
                          <p class="m-b-10 text-primary">No Offer : {{ $offer['noOffer'] }}</p>
                        </div>
                    </div> 

                    <br>            
            
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center justify-content-start mt-2">
                            <p class="mb-0 fw-bold">{{ $offer['origin']}}</p>                      
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 10px; height: 10px;"></div>
                                <div class="bg-primary mx-2" style="width: 50px; height: 1px;"></div>
                                {{-- <i class="ti ti-clock mx text-primary"></i> --}}
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
                        </div>
                    </div>                    
                </div>
              </div> 
            </div> 
      <form action="/order/perform" method="POST" id="orderForm">
        @csrf
        <div class="row">
            <!-- Detail Penawaran -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  {{-- <div class="row">
                    <div class="col-6">
                      <p class="mb-3">Tanggal Muat Barang</p>
                    </div>
                    <div class="col-6 text-end">
                      <p class="mb-3 text-primary">{{$offer->getpickup}}</p>
                    </div>
                  </div> --}}
                  @if ($offer['shipmentType'] == 'FCL')
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-3">Volume :</p>
                    </div>
                    <div class="col-6 text-end">
                      <div class="d-flex justify-content-end align-items-center">
                        <p class="text-danger fw-bold mb-0">{{ $offer['maxVolume'] }} CBM</p>
                        <p class="mb-0 ms-2 text-gray-500">/ Container</p>
                      </div>
                    </div>
                  </div>  
                  @else
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-3">Sisa Volume :</p>
                    </div>
                    <div class="col-6 text-end">
                      <div class="d-flex justify-content-end align-items-center">
                        <p class="text-danger fw-bold mb-0">{{ $offer['remainingVolume'] }}</p>
                        <p class="mb-0 ms-2 text-gray-500">/ {{ $offer['maxVolume'] }} CBM</p>
                      </div>
                    </div>
                  </div>
                  @endif

                  @if ($offer['shipmentType'] == 'FCL')
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-3">Berat :</p>
                    </div>
                    <div class="col-6 text-end">
                      <div class="d-flex justify-content-end align-items-center">
                        <p class="text-danger fw-bold mb-0">{{ $offer['maxWeight'] }} kg</p>
                        <p class="mb-0 ms-2 text-gray-500">/ Container</p>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-3">Sisa Berat :</p>
                    </div>
                    <div class="col-6 text-end">
                      <div class="d-flex justify-content-end align-items-center">
                        <p class="text-danger fw-bold mb-0">{{ $offer['remainingWeight'] }}</p>
                        <p class="mb-0 ms-2 text-gray-500">/ {{ $offer['maxWeight'] }} kg</p>
                      </div>
                    </div>
                  </div>
                  @endif

                  <hr>

                  <div id="cbmPriceCard"></div>
                  <div id="servicePriceList"></div>

                  <hr>

                  <div class="text-end">
                    <p class="mb-3 text-gray-500">Total</p>
                    <h5 class="mb-3 text-danger" id="totalPrice">Rp. 0</h5>
                  </div>
                </div>
              </div>

              <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col">
                        <h5 class="mb-0">Container Availability</h5>
                      </div>
                      <div class="col text-end">
                        @if ($offer->container)
                          <span class="text-primary">{{ $offer->container->name }}</span>
                        @else
                          <span class="text-muted text-primary">Tidak ada detail kontainer</span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="row justify-content-center align-items-center">
                      <div class="col-md-10 col-lg-8">
                        <div class="card w-100">
                          <div class="container" id="container"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-center">
                    <span class="badge bg-success me-2"><i class="ti ti-check"></i> Available</span>
                    <span class="badge bg-danger"><i class="ti ti-x"></i> Booked</span>
                  </div>
                </div>
              </div>
            </div>
            </div>

            <!-- Form input -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="mb-3">Form Pemesanan</h4>
                  @if ($offer['shipmentType'] == 'FCL')
                  @php
                    $oldItems = old('items', [ [] ]);
                  @endphp
                  <div class="row">
                    <div class="col-12">
                        <select class="form-control" name="items[0][commodities]">
                            @foreach ($categories as $category)
                              <option value="{{$category->name}}">{{$category->code}} - {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-6">
                      <div class="input-group mb-3">
                      <input type="number" name="items[0][weight]" class="form-control weight" placeholder="Berat" value="{{ old("items.weight", $item['weight'] ?? '') }}">
                      <span class="input-group-text"> kg</span>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="input-group mb-3">
                      <input type="number" name="items[0][qty]" class="form-control qty" placeholder="Qty" value="{{ old("items.qty", $item['qty'] ?? '') }}">
                      <span class="input-group-text"> qty</span>
                      </div>
                    </div>
                  </div>
                  <input type="number" name="items[0][length]" class="form-control length" placeholder="Panjang (cm)" value=1 hidden>
                  <input type="number" name="items[0][width]" class="form-control width" placeholder="Lebar (cm)" value=1 hidden>
                  <input type="number" name="items[0][height]" class="form-control height" placeholder="Tinggi (cm)" value=1 hidden>
                  <input type="number" name="items[0][volume]" class="form-control volume" hidden value="{{ $offer['maxVolume'] }}">
                  @else
                  <div id="itemsContainer">
                  @php
                    $oldItems = old('items', [ [] ]);
                  @endphp
                  @foreach ($oldItems as $i => $item)
                  <div class="item-row border p-3 mb-3">
                    <div class="row">
                      <div class="col-md-10">
                        <select class="form-control" name="items[{{ $i }}][commodities]">
                          @foreach ($categories as $category)
                            <option value="{{$category->name}}" {{ (old("items.$i.commodities", $item['commodities'] ?? '') == $category->name) ? 'selected' : '' }}>
                              {{$category->code}} - {{$category->name}}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-icon btn-light-danger remove-item"><i class="ti ti-trash"></i></button>
                      </div>
                    </div>
                    <div class="item">
                      <div class="row mt-3">
                        <div class="col-md-12">
                          <div class="input-group mb-3">
                              <input type="number" name="items[{{ $i }}][length]" class="form-control length" placeholder="Panjang" value="{{ old("items.$i.length", $item['length'] ?? '') }}">
                              <span class="input-group-text"><i class="ti ti-x"></i></span>
                              <input type="number" name="items[{{ $i }}][width]" class="form-control width" placeholder="Lebar" value="{{ old("items.$i.width", $item['width'] ?? '') }}">
                              <span class="input-group-text"><i class="ti ti-x"></i></span>
                              <input type="number" name="items[{{ $i }}][height]" class="form-control height" placeholder="Tinggi" value="{{ old("items.$i.height", $item['height'] ?? '') }}">
                              <span class="input-group-text">cm</span>
                            </div>
                        </div>
                        {{-- <div class="col-4">
                          <div class="input-group mb-3">
                          <input type="number" name="items[{{ $i }}][width]" class="form-control width" placeholder="Lebar" value="{{ old("items.$i.width", $item['width'] ?? '') }}">
                          <span class="input-group-text"> cm</span>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="input-group mb-3">
                          <input type="number" name="items[{{ $i }}][height]" class="form-control height" placeholder="Tinggi" value="{{ old("items.$i.height", $item['height'] ?? '') }}">
                          <span class="input-group-text"> cm</span>
                          </div>
                        </div> --}}
                      </div>
                      <div class="row mt-0">
                        <div class="col-5">
                          <div class="input-group mb-3">
                          <input type="number" name="items[{{ $i }}][weight]" class="form-control weight" placeholder="Berat" value="{{ old("items.$i.weight", $item['weight'] ?? '') }}">
                          <span class="input-group-text"> kg</span>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="input-group mb-3">
                          <input type="number" name="items[{{ $i }}][qty]" class="form-control qty" placeholder="Qty" value="{{ old("items.$i.qty", $item['qty'] ?? '') }}">
                          <span class="input-group-text"> qty</span>
                          </div>
                        </div>
                        <div class="col-3">
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
                  <div class="text-end mb-3">
                    <button type="button" id="addItemBtn" class="btn btn-secondary">+ Tambah Barang</button>
                  </div>
                  @endif
                  <hr>
                  <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">Volume: <span id="cbmResult">0</span> CBM</p>
                        <p class="fw-bold">CBM yang Harus Dibeli: <span id="cbmToBuy">0</span> CBM</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col">
                      <label class="form-label">Daftar Layanan</label>
                      @foreach ($services as $item)
                          <div class="form-check">
                              <input class="form-check-input service-checkbox" type="checkbox" 
                                     value="{{ $item->id }}" 
                                      name="selected_services[]"
                                     data-price="{{ $item['price'] }}"
                                     data-name="{{ $item['serviceName'] }}"
                                     onclick="updateServices()">
                              <i class="{{$item->icon}} me-1"></i>
                              <label class="form-check-label">
                                  {{ $item['serviceName'] }}
                              </label>
                          </div>
                      @endforeach
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Nama Penerima</label>
                      <input type="text" name="receiverName" class="form-control" placeholder="Nama Penerima" value="{{ old('receiverName') }}">
                      @error('receiverName') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">No Telepon Penerima</label>
                      <div class="input-group mb-3">
                      <span class="input-group-text">+62</span>
                      <input type="text" name="receiverTelpNumber" class="form-control" placeholder="" value="{{ old('receiverTelpNumber') }}">
                      </div>
                      @error('receiverTelpNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group mb-3">
                      <div class="col-md-12">
                        <label class="form-label">Ready To Load</label>
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
                  </div>
                  @if ($offer['shipmentMode'] == 'D2D' || $offer['shipmentMode'] == 'D2P')
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Alamat Pick Up</label>
                      <textarea class="form-control" name="originAddress" rows="2" placeholder="Alamat Pick Up">{{ old('originAddress') }}</textarea>
                      @error('originAddress') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  @else
                   <input class="form-control" name="originAddress" rows="2" placeholder="Alamat Pick Up" value="" hidden></input>
                  @endif

                  @if ($offer['shipmentMode'] == 'D2D' || $offer['shipmentMode'] == 'P2D')
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Alamat Tujuan</label>
                      <textarea class="form-control" name="destinationAddress" rows="2" placeholder="Alamat Tujuan">{{ old('destinationAddress') }}</textarea>
                      @error('destinationAddress') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  @else
                  <input class="form-control" name="destinationAddress" rows="2" placeholder="Alamat Tujuan" value="" hidden></input>
                  @endif
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Informasi Tambahan</label>
                      <textarea class="form-control" name="description" rows="2" placeholder="Informasi Tambahan">{{ old('description') }}</textarea>
                      @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>

                  <!-- Input Hidden-->
                  <div class="row">
                    <input type="text" name="noOffer" class="form-control" value="{{ $offer['noOffer'] }}" hidden>
                    <input type="text" name="lspName" class="form-control" value="{{ $offer['lspName'] }}" hidden>
                    <input type="text" name="origin" class="form-control" value="{{ $offer['origin'] }}" hidden>
                    <input type="text" name="portOrigin" class="form-control" value="{{ $offer['portOrigin'] }}" hidden>
                    <input type="text" name="destination" class="form-control" value="{{ $offer['destination'] }}" hidden>
                    <input type="text" name="portDestination" class="form-control" value="{{ $offer['portDestination'] }}" hidden>
                    <input type="text" name="shipmentMode" class="form-control" value="{{ $offer['shipmentMode'] }}" hidden>
                    <input type="text" name="shipmentType" class="form-control" value="{{ $offer['shipmentType'] }}" hidden>
                    <input type="text" name="transportationMode" class="form-control" value="{{ $offer['transportationMode'] }}" hidden>
                    <input type="datetime" name="pickupDate" class="form-control" value="{{ $offer['pickupDate'] }}" hidden>
                    <input type="datetime" name="departureDate" class="form-control" value="{{ $offer['departureDate'] }}" hidden>
                    <input type="datetime" name="cyClosingDate" class="form-control" value="{{ $offer['cyClosingDate'] }}" hidden>
                    <input type="datetime" name="etd" class="form-control" value="{{ $offer['etd'] }}" hidden>
                    <input type="datetime" name="eta" class="form-control" value="{{ $offer['eta'] }}" hidden>
                    <input type="datetime" name="deliveryDate" class="form-control" value="{{ $offer['deliveryDate'] }}" hidden>
                    <input type="datetime" name="arrivalDate" class="form-control" value="{{ $offer['arrivalDate'] }}" hidden>
                    <input type="number" name="maxWeight" class="form-control" value="{{ $offer['maxWeight'] }}" hidden>
                    <input type="number" name="maxVolume" class="form-control" value="{{ $offer['maxVolume'] }}" hidden>
                    <input type="number" name="price" class="form-control" value="{{ $offer['price'] }}" hidden>
                    <input type="number" name="remainingWeight" class="form-control" value="{{ $offer['remainingWeight'] }}" hidden>
                    <input type="number" name="remainingVolume" class="form-control" value="{{ $offer['remainingVolume'] }}" hidden>
                    <input type="number" id="cbmInput" name="total_cbm" hidden>
                    <input type="number" id="totalPriceInput" name="total_price" hidden>
                    {{-- <input type="text" id="selectedServicesInput" name="selected_services" class="form-control" hidden> --}}
                    <input type="number" id="user_id" name="user_id" class="form-control"  value="{{ $offer['user_id'] }}" hidden>
                    <input type="text" id="is_for_lsp" name="is_for_lsp" class="form-control"  value="{{ $offer['is_for_lsp'] }}" hidden>
                    <input type="text" id="is_for_customer" name="is_for_customer" class="form-control"  value="{{ $offer['is_for_customer'] }}" hidden>
                    <input type="text" id="status" name="status" class="form-control"  value="{{ $offer['status'] }}" hidden>
                    <input type="text" id="lsp_id" name="lsp_id" class="form-control"  value="{{ $offer['user_id'] }}" hidden>
                    <input type="text" id="truck_second_id" name="truck_second_id" class="form-control"  value="{{ $offer['truck_second_id'] }}" hidden>
                    <input type="text" id="truck_first_id" name="truck_first_id" class="form-control"  value="{{ $offer['truck_first_id'] }}" hidden>
                    <input type="text" id="cargoType" name="cargoType" class="form-control"  value="{{ $offer['cargoType'] }}" hidden>
                    <input type="text" id="container_id" name="container_id" class="form-control"  value="{{ $offer['container_id'] }}" hidden>
                  </div>
                  {{-- <div class="row">
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
                  </div> --}}
                  <div class="row">
                    <div class="col-12 text-end">
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Pesan Sekarang</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
      </form>
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
                        Apakah anda yakin memesan penawaran ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
          let itemIndex = 1;

          document.getElementById('addItemBtn').addEventListener('click', function () {
            const container = document.getElementById('itemsContainer');
            const newItem = document.querySelector('.item-row').cloneNode(true);

            const itemIndex = container.querySelectorAll('.item-row').length;

            newItem.querySelectorAll('input, select').forEach((input) => {
              const name = input.getAttribute('name');
              const newName = name.replace(/\[\d+\]/, `[${itemIndex}]`);
              input.setAttribute('name', newName);
              if (input.tagName === "SELECT") {
                input.selectedIndex = 0;
              } else {
                input.value = '';
              }
            });

            container.appendChild(newItem);
            registerCBMListeners(); // 
          });

          document.getElementById('itemsContainer').addEventListener('click', function (e) {
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
        </script>

        <script>
          function registerCBMListeners() {
            document.querySelectorAll(".item input").forEach(input => {
              input.removeEventListener("input", calculateCBM);
              input.addEventListener("input", calculateCBM);
            });

            document.querySelectorAll('.item-row select').forEach(select => {
              select.removeEventListener("change", calculateCBM);
              select.addEventListener("change", calculateCBM);
            });
          }     
            document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('orderForm').submit();
            });

          function calculateCBM() {
            let shipmentType = "{{ $offer['shipmentType'] }}";
            let cbmPrice = parseFloat("{{ $offer['price'] }}") || 0;
            let maxVolume = parseFloat("{{ $offer['maxVolume'] }}") || 0;
            let maxWeightPerCBM = 600;

            let cbmPriceCard = document.getElementById("cbmPriceCard");
            let cbmCardHTML = "";
            let totalCBMToBuy = 0;
            let totalCBM = 0;

            if (shipmentType === 'FCL') {
              let categorySelect = document.querySelector('select[name="items[0][commodities]"]');
              let categoryName = categorySelect ? categorySelect.options[categorySelect.selectedIndex].text : 'Barang';
              let qty = parseFloat(document.querySelector('input[name="items[0][qty]"]')?.value) || 0;

              let cbmToBuy = qty * maxVolume;
              totalCBMToBuy = cbmToBuy;
              totalCBM = cbmToBuy;

              let subtotal = cbmToBuy * cbmPrice;

              cbmCardHTML += `
                <div class="card bg-light-primary mb-1">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-6">
                        <p class="mb-0 text-black">${qty}x Container : ${cbmToBuy} CBM</p>
                      </div>
                      <div class="col-6 text-end">
                        <p class="mb-0 text-black">Rp. ${subtotal.toLocaleString("id-ID")}</p>
                      </div>
                    </div>
                  </div>
                </div>
              `;
            } else {
              const items = document.querySelectorAll(".item");
              items.forEach((item, idx) => {
                let categorySelect = item.closest('.item-row').querySelector('select[name^="items"]');
                let categoryName = categorySelect ? categorySelect.options[categorySelect.selectedIndex].text : `Barang ${idx+1}`;

                let length = parseFloat(item.querySelector(".length")?.value) || 0;
                let width = parseFloat(item.querySelector(".width")?.value) || 0;
                let height = parseFloat(item.querySelector(".height")?.value) || 0;
                let weight = parseFloat(item.querySelector(".weight")?.value) || 0;
                let qty = parseFloat(item.querySelector(".qty")?.value) || 0;

                let lengthM = length / 100;
                let widthM = width / 100;
                let heightM = height / 100;

                let cbmRounded = 0, cbmByWeight = 0, cbmByVolume = 0, cbmToBuy = 0;

                let cbm = lengthM * widthM * heightM;
                cbmRounded = Math.ceil(cbm * 1000) / 1000;
                cbmByWeight = Math.ceil(weight / maxWeightPerCBM);
                cbmByVolume = Math.ceil(cbmRounded);
                let volumeInput = item.querySelector('.volume');
                let extraCBM = 0;
                if (length > 100) extraCBM++;
                if (width > 100) extraCBM++;
                if (height > 100) extraCBM++;
                cbmToBuy = (Math.max(cbmByVolume, cbmByWeight) + extraCBM) * qty;
                totalCBM += cbmRounded * qty;
                totalCBMToBuy += cbmToBuy;
                if (volumeInput) volumeInput.value = cbmToBuy;

                let subtotal = cbmToBuy * cbmPrice;

                cbmCardHTML += `
                  <div class="card bg-light-primary mb-1">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="col-6">
                          <p class="mb-0 text-black">${categoryName} ${cbmToBuy} CBM</p>
                        </div>
                        <div class="col-6 text-end">
                          <p class="mb-0 text-black">Rp. ${subtotal.toLocaleString("id-ID")}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                `;
              });
            }

            cbmPriceCard.innerHTML = cbmCardHTML;
            document.getElementById("cbmResult").innerText = totalCBM.toFixed(3);
            document.getElementById("cbmToBuy").innerText = totalCBMToBuy;

            updateTotalPrice();
            // console.log({ totalCBM, totalCBMToBuy });
          }
          function updateTotalPrice() {
            let totalPrice = 0;
            let cbmToBuy = parseInt(document.getElementById("cbmToBuy").innerText) || 0;
            let cbmPrice = {{$offer['price']}};
            totalPrice += cbmToBuy * cbmPrice;
            let selectedServices = document.querySelectorAll(".service-checkbox:checked");
            selectedServices.forEach(service => {
                let servicePrice = parseFloat(service.getAttribute("data-price"));
                totalPrice += servicePrice;
            });
            document.getElementById("totalPrice").innerText = `Rp. ${totalPrice.toLocaleString("id-ID")}`;
            document.getElementById("cbmInput").value = cbmToBuy;
            document.getElementById("totalPriceInput").value = totalPrice;
        }
          function updateServices() {
            let selectedServices = document.querySelectorAll(".service-checkbox:checked");
            let servicePriceList = document.getElementById("servicePriceList");
            servicePriceList.innerHTML = ""; 
            let selectedServiceNames = []; 

            selectedServices.forEach(service => {
                let serviceId = service.value;
                let serviceName = service.getAttribute("data-name");
                let servicePrice = parseFloat(service.getAttribute("data-price"));
                selectedServiceNames.push(serviceName); 
                let formattedPrice = servicePrice.toLocaleString("id-ID");
                servicePriceList.innerHTML += `
                    <div class="card bg-light-primary mb-1">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-0 text-black">${serviceName}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="mb-0 text-black">Rp. ${formattedPrice}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            updateTotalPrice();
        }
          document.querySelectorAll(".service-checkbox").forEach(checkbox => {
              checkbox.addEventListener("change", updateServices);
          });


        </script>
        <script>
          let totalCBM = parseInt("{{ $offer['maxVolume'] }}");
          let bookedCBM = parseInt("{{ $offer['maxVolume'] - $offer['remainingVolume'] }}");
      
          function renderContainer() {
              const container = document.getElementById("container");
              container.innerHTML = "";
      
              for (let i = 0; i < totalCBM; i++) {
                  const box = document.createElement("div");
                  box.classList.add("box", "border", "d-flex", "justify-content-center", "align-items-center");
      
                  let icon = document.createElement("i");
      
                  if (i < bookedCBM) {
                      box.classList.add("booked", "bg-danger");
                      icon.classList.add("ti", "ti-x", "text-white");
                  } else {
                      box.classList.add("available", "bg-success");
                      icon.classList.add("ti", "ti-check", "text-white");
                  }
      
                  box.appendChild(icon);
                  container.appendChild(box);
              }
          }
      
          document.addEventListener("DOMContentLoaded", renderContainer);
          document.addEventListener("DOMContentLoaded", function() {
            if ("{{ $offer['shipmentType'] }}" === "FCL") {
              document.querySelector('input[name="items[0][qty]"]').addEventListener('input', calculateCBM);
              document.querySelector('select[name="items[0][commodities]"]').addEventListener('change', calculateCBM);
            }
            registerCBMListeners();
            calculateCBM();
          });
        </script>
    
@endsection