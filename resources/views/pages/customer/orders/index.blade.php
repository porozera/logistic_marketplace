@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Pemesanan')
@section('style')
<style>
  .container {
      display: grid;
      grid-template-columns: repeat(11, 30px); /* 11 kolom per baris */
      gap: 5px;
      margin: 20px;
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
  }
  .available {
      background-color: green;
      color: white;
  }
  .booked {
      background-color: red;
      color: white;
  }
  .square-box {
      width: 40px; 
      height: 40px; 
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
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Cari Rute</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Rute</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detail Pemesanan</li>
                </ul>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
          <h3 class="m-b-10">Detail Pemesanan</h3>
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
                          @if ($offer->shipmentMode == 'D2D')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> Door to Door
                              </button>   
                          @elseif( $offer->shipmentMode == 'D2P')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> Door to Port
                              </button>
                          @elseif( $offer->shipmentMode == 'P2P')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-sailboat me-1"></i> Port to Port
                              </button>
                          @elseif( $offer->shipmentMode == 'P2D')
                              <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                  <i class="ti ti-truck-delivery me-1"></i> Port to Door
                              </button>
                          @endif

                            <button type="button" class="btn btn-success rounded-pill">
                              {{ $offer['shipmentType'] == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                            </button>
                        
                                                                    
                        </div>
            
                        <div class="col-md-2 text-end">
                          <p class="m-b-10 text-primary">ID : {{ $offer['noOffer'] }}</p>
                        </div>
                    </div> 

                    <br>            
            
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center justify-content-start mt-2">
                            <p class="mb-0 fw-bold">{{ $offer['origin']}}</p>                      
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 100px; height: 1px;"></div>
                                <i class="ti ti-clock mx text-primary"></i> <p class="mb-0 mx-2 text-primary">{{ $offer['estimated_days']}} Hari</p> 
                                <div class="bg-primary mx-2" style="width: 100px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
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
        </div>


      
      
      
        

      <form action="/order/perform" method="POST" id="orderForm">
        @csrf
        <div class="row">
            <!-- Detail Penawaran -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <p class="mb-3">Tanggal Muat Barang</p>
                  </div>
                  <div class="col-6 text-end">
                    <p class="mb-3 text-primary">{{$offer['loading_date_formatted']}}</p>
                  </div>
                  </div>
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
                  <div class="row">
                  <div class="col-6">
                    <p class="mb-3">Sisa Berat :</p>
                  </div>
                  <div class="col-6 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                    <p class="text-danger fw-bold mb-0">{{ $offer['remainingWeight'] }}</p>
                    <p class="mb-0 ms-2 text-gray-500">/ {{ $offer['maxWeight'] }} Kg</p>
                    </div>
                        </div>
                      </div>
                      <div class="row">
                        <p>Alamat Tujuan:</p> 
                            <p class="text-primary">{{ optional($order)->address ?? '-' }}</p>
                      </div>

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
                      <h5 class="mb-0">Container Availability</h5>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                      <div class="col-2"></div>
                      <div class="col-9 d-flex justify-content-center">
                        <div class="card">
                          <div class="container" id="container"></div>
                        </div>
                      </div>
                      <div class="col-1"></div>
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
                  @if ($offer['shipmentType'] == 'LCL')
                  <div class="row">
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Panjang (cm)</label>
                            <input type="number" id="length" name="length" class="form-control" placeholder="cm" value="{{ old('length') }}" oninput="calculateCBM()">
                            @error('length') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Lebar (cm)</label>
                            <input type="number" id="width" name="width" class="form-control" placeholder="cm" value="{{ old('width') }}" oninput="calculateCBM()">
                            @error('width') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mb-3">
                            <label class="form-label">Tinggi (cm)</label>
                            <input type="number" id="height" name="height" class="form-control" placeholder="cm" value="{{ old('height') }}" oninput="calculateCBM()">
                            @error('height') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Berat (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" placeholder="kg" value="{{ old('weight') }}" oninput="calculateCBM()">
                        @error('weight') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                      </div>
                    </div>

                  @else

                  <input type="number" id="height" name="height" class="form-control" placeholder="cm" value="0" hidden>
                  <input type="number" id="width" name="width" class="form-control" placeholder="cm" value="0" hidden>
                  <input type="number" id="length" name="length" class="form-control" placeholder="cm" value="0" hidden>
                  
                  <div class="form-group mb-3">
                    <label class="form-label">Volume (CBM)</label>
                    <input type="number" id="volume" name="volume" class="form-control" placeholder="CBM" value="{{ $offer['maxVolume'] }}" oninput="calculateCBM()" readonly>
                    @error('volume') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Berat (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" placeholder="kg" value="{{ $offer['maxWeight'] }}" oninput="calculateCBM()" readonly>
                        @error('weight') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                      </div>
                    </div>
                  @endif

                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Tipe Barang</label>
                        <select class="form-control" name="commodities" id="commodities">
                            @foreach ($categories as $category)
                            <option value="{{$category->name}}">{{$category->code}} - {{$category->name}}</option>
                            @endforeach
                            {{-- <option value="Parfum">Parfum</option>
                            <option value="Binatang">Binatang</option> --}}
                        </select>                            
                        @error('commodities') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                        <p class="fw-bold">Volume: <span id="cbmResult">0</span> CBM</p>
                        <p class="fw-bold">CBM yang Harus Dibeli: <span id="cbmToBuy">0</span> CBM</p>
                    </div>
                </div>

                  <div class="row">
                    <div class="col">
                      <label class="form-label">Daftar Layanan</label>
                      @foreach ($services as $item)
                          <div class="form-check">
                              <input class="form-check-input service-checkbox" type="checkbox" 
                                     value="{{ $item['serviceName'] }}" 
                                     data-price="{{ $item['price'] }}"
                                     onclick="updateServices()">
                              <i class="{{$item->icon}} me-1"></i>
                              <label class="form-check-label">
                                  {{ $item['serviceName'] }}
                              </label>
                          </div>
                      @endforeach
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">No Telepon</label>
                      <input type="text" name="telpNumber" class="form-control" placeholder="+62" value="{{ old('telpNumber') }}">
                      @error('telpNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  <div class="row">
                    @if (optional($order)->address == null)
                    <div class="form-group mb-3">
                      <label class="form-label">Alamat Tujuan</label>
                      <textarea class="form-control" name="address" rows="4" placeholder="Alamat Tujuan">{{ old('address') }}</textarea>
                      @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                    @endif
                  </div>
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Informasi Tambahan</label>
                      <textarea class="form-control" name="description" rows="4" placeholder="Informasi Tambahan">{{ old('description') }}</textarea>
                      @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>

                  <!-- Input Hidden-->
                  <div class="row">
                    <input type="text" name="noOffer" class="form-control" value="{{ $offer['noOffer'] }}" hidden>
                    <input type="text" name="lspName" class="form-control" value="{{ $offer['lspName'] }}" hidden>
                    <input type="text" name="origin" class="form-control" value="{{ $offer['origin'] }}" hidden>
                    <input type="text" name="destination" class="form-control" value="{{ $offer['destination'] }}" hidden>
                    <input type="text" name="shipmentMode" class="form-control" value="{{ $offer['shipmentMode'] }}" hidden>
                    <input type="text" name="shipmentType" class="form-control" value="{{ $offer['shipmentType'] }}" hidden>
                    <input type="date" name="loadingDate" class="form-control" 
                    value="{{ \Carbon\Carbon::parse($offer['loadingDate'])->format('Y-m-d') }}" hidden>
             
                    <input type="date" name="estimationDate" class="form-control" 
                            value="{{ \Carbon\Carbon::parse($offer['estimationDate'])->format('Y-m-d') }}" hidden>
                    
                    <input type="date" name="shippingDate" class="form-control" 
                            value="{{ \Carbon\Carbon::parse($offer['shippingDate'])->format('Y-m-d') }}" hidden>
             
                    <input type="number" name="maxWeight" class="form-control" value="{{ $offer['maxWeight'] }}" hidden>
                    <input type="number" name="maxVolume" class="form-control" value="{{ $offer['maxVolume'] }}" hidden>
                    <input type="number" name="price" class="form-control" value="{{ $offer['price'] }}" hidden>
                    <input type="number" name="remainingWeight" class="form-control" value="{{ $offer['remainingWeight'] }}" hidden>
                    <input type="number" name="remainingVolume" class="form-control" value="{{ $offer['remainingVolume'] }}" hidden>
                    <input type="number" id="cbmInput" name="total_cbm" hidden>
                    <input type="number" id="totalPriceInput" name="total_price" hidden>
                    <input type="text" id="selectedServicesInput" name="selected_services" class="form-control" hidden>
                    <input type="number" id="user_id" name="user_id" class="form-control"  value="{{ $offer['user_id'] }}" hidden>
                    <input type="text" id="is_for_lsp" name="is_for_lsp" class="form-control"  value="{{ $offer['is_for_lsp'] }}" hidden>
                    <input type="text" id="is_for_customer" name="is_for_customer" class="form-control"  value="{{ $offer['is_for_customer'] }}" hidden>
                    <input type="text" id="status" name="status" class="form-control"  value="{{ $offer['status'] }}" hidden>
                    <input type="text" id="lsp_id" name="lsp_id" class="form-control"  value="{{ $offer['user_id'] }}" hidden>
                    <input type="text" id="truck_second_id" name="truck_second_id" class="form-control"  value="{{ $offer['truck_second_id'] }}" hidden>
                    <input type="text" id="truck_first_id" name="truck_first_id" class="form-control"  value="{{ $offer['truck_first_id'] }}" hidden>
                    <input type="text" id="cargoType" name="cargoType" class="form-control"  value="{{ $offer['cargoType'] }}" hidden>
                    @if (optional($order)->address != null)
                    <input type="text" id="address" name="address" class="form-control"  value="{{ $order['address'] }}" hidden>
                    @endif
                  </div>
                  <div class="row">
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
                  </div>
                  <div class="row">
                    <div class="col-12">
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
              window.onload = function() {
                calculateCBM();
            };
            document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('orderForm').submit();
            });

            function calculateCBM() {
              let length = parseFloat(document.getElementById("length")?.value) || 0;
              let width = parseFloat(document.getElementById("width")?.value) || 0;
              let height = parseFloat(document.getElementById("height")?.value) || 0;
              let weight = parseFloat(document.getElementById("weight")?.value) || 0;
              let volume = parseFloat(document.getElementById("volume")?.value) || 0;

              let lengthM = length / 100;
              let widthM = width / 100;
              let heightM = height / 100;

              let cbm, cbmRounded, cbmByWeight, cbmByVolume;
              let maxWeightPerCBM = 600;
              
              let shipmentType = "{{ $offer['shipmentType'] }}";
              let maxVolume = parseFloat("{{ $offer['maxVolume'] }}") || 0;
              let maxWeight = parseFloat("{{ $offer['maxWeight'] }}") || 0;
              let cbmPrice = parseFloat("{{ $offer['price'] }}") || 0;

              if (shipmentType === 'LCL') {
                  cbm = lengthM * widthM * heightM;
                  cbmRounded = Math.ceil(cbm * 1000) / 1000;
                  cbmByWeight = Math.ceil(weight / maxWeightPerCBM);
                  cbmByVolume = Math.ceil(cbmRounded);
                  extraCBM = 0;
                  if (length > 100) extraCBM++;
                  if (width > 100) extraCBM++;
                  if (height > 100) extraCBM++;
                  cbmToBuy = Math.max(cbmByVolume, cbmByWeight) + extraCBM;
              } else {
                  cbmRounded = maxVolume;
                  cbmByWeight = maxWeight;
                  cbmByVolume = Math.ceil(cbmRounded);
                  cbmToBuy = maxVolume;
              }

              let totalCBMPrice = cbmToBuy * cbmPrice;

              document.getElementById("cbmResult").innerText = cbmRounded.toFixed();
              document.getElementById("cbmToBuy").innerText = cbmToBuy;

              let cbmPriceCard = document.getElementById("cbmPriceCard");
              cbmPriceCard.innerHTML = `
                  <div class="card bg-light-primary mb-1">
                      <div class="card-body p-3">
                          <div class="row">
                              <div class="col-6">
                                  <p class="mb-0 text-black">Total CBM: ${cbmToBuy}</p>
                              </div>
                              <div class="col-6 text-end">
                                  <p class="mb-0 text-black">Rp. ${totalCBMPrice.toLocaleString("id-ID")}</p>
                              </div>
                          </div>
                      </div>
                  </div>
              `;

              updateTotalPrice();
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
            let selectedServicesInput = document.getElementById("selectedServicesInput");
            servicePriceList.innerHTML = ""; 
            let selectedServiceNames = []; 

            selectedServices.forEach(service => {
                let serviceName = service.value;
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
            selectedServicesInput.value = selectedServiceNames.join(", ");
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
      </script>
    
@endsection