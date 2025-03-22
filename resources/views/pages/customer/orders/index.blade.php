@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Pemesanan')
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
                                <img src="{{ asset('template/mantis/dist/assets/images/user/avatar-2.jpg') }}" 
                                     alt="profile-lsp" 
                                     class="user-avtar wid-35 rounded-circle">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold">{{ $offer['lspName']}}</h5>
                                <i class="fas fa-star text-warning"></i>
                                <h5 class="mb-0 fw-bold">5.0</h5>
                            </div>
                        </div>
            
                        <div class="col-md-4 d-flex justify-content-center gap-2">
                            @if ($offer['shipmentMode'] == 'laut')
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-sailboat me-1"></i> Laut
                                </button>   
                            @else
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-truck-delivery me-1"></i> Darat
                                </button>
                            @endif

                            <button type="button" class="btn btn-success rounded-pill">
                              {{ $offer['shipmentType'] == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                            </button>
                        
                                                                    
                        </div>
            
                        <div class="col-md-2 text-end">
                          <h4 class="m-b-10 text-primary">ID : {{ $offer['noOffer'] }}</h4>
                        </div>
                    </div> 

                    <br>            
            
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center justify-content-start mt-2">
                            <h5 class="mb-0 fw-bold">{{ $offer['origin']}}</h5>                      
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 200px; height: 1px;"></div>
                                <i class="ti ti-clock mx text-primary"></i> <h5 class="mb-0 mx-2 text-primary">{{ $offer['estimated_days']}} Hari</h5> 
                                <div class="bg-primary mx-2" style="width: 200px; height: 1px;"></div>
                                <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                            </div>
                            <h5 class="mb-0 fw-bold">{{ $offer['destination']}}</h5>
                        </div>

                        <div class="col-md-4 text-end mt-2">
                            <div class="d-flex align-items-center justify-content-end mb-2">
                                <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($offer['price'], 0, ',', '.')}}</h4>
                                <h5 class="mb-0 ms-2">/CBM</h5>
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
                          <h5 class="mb-3">Tanggal Muat Barang</h5>
                        </div>
                        <div class="col-6 text-end">
                          <h4 class="mb-3 text-primary">{{$offer['loading_date_formatted']}}</h4>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <h5 class="mb-3">Sisa Volume :</h5>
                        </div>
                        <div class="col-6 text-end">
                          <div class="d-flex justify-content-end align-items-center">
                            <h5 class="text-danger fw-bold mb-0">{{ $offer['remainingVolume'] }}</h5>
                            <p class="mb-0 ms-2 text-gray-500">/ {{ $offer['maxVolume'] }} CBM</p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <h5 class="mb-3">Sisa Berat :</h5>
                        </div>
                        <div class="col-6 text-end">
                          <div class="d-flex justify-content-end align-items-center">
                            <h5 class="text-danger fw-bold mb-0">{{ $offer['remainingWeight'] }}</h5>
                            <p class="mb-0 ms-2 text-gray-500">/ {{ $offer['maxWeight'] }} Kg</p>
                          </div>
                        </div>
                      </div>

                      <hr>

                      {{-- <div class="card bg-light-primary mb-1" style="height: auto;">
                        <div class="card-body p-3"> <!-- Mengurangi padding -->
                          <div class="row">
                            <div class="col-6">
                              <h5 class="mb-0">Kontainer 3 CBM</h5> <!-- Gunakan h6 agar lebih kecil -->
                            </div>
                            <div class="col-6 text-end">
                              <h5 class="mb-0">Rp. 400.000</h5> <!-- Gunakan h6 agar lebih kecil -->
                            </div>
                          </div>
                        </div>
                      </div> --}}

                      <div id="cbmPriceCard"></div> 
                      <div id="servicePriceList"></div>

                      <hr>

                      <div class="text-end">
                        <h5 class="mb-3 text-gray-500">Total</h5>
                        <h4 class="mb-3 text-danger" id="totalPrice">Rp. 0</h4>
                      </div>
                    </div>
                </div>
            </div>

            <!-- Form input -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="mb-3">Form Pemesanan</h4>
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
                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Tipe Barang</label>
                        <select class="form-control" name="commodities" id="commodities">
                            <option value=""></option>
                            <option value="Parfum">Parfum</option>
                            <option value="Binatang">Binatang</option>
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
                    <div class="form-group mb-3">
                      <label class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="description" rows="4" placeholder="Deskripsi">{{ old('description') }}</textarea>
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
                  </div>
                  <div class="row">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('orderForm').submit();
            });

            function calculateCBM() {
              let length = parseFloat(document.getElementById("length").value) || 0;
              let width = parseFloat(document.getElementById("width").value) || 0;
              let height = parseFloat(document.getElementById("height").value) || 0;
              let weight = parseFloat(document.getElementById("weight").value) || 0;

              let lengthM = length / 100;
              let widthM = width / 100;
              let heightM = height / 100;
              let cbm = lengthM * widthM * heightM;
              let cbmRounded = Math.ceil(cbm * 1000) / 1000;

              let maxWeightPerCBM = 600;
              let cbmByVolume = Math.ceil(cbmRounded);
              let cbmByWeight = Math.ceil(weight / maxWeightPerCBM);

              // Peraturan tambahan: jika panjang, lebar, atau tinggi lebih dari 100m, tambahkan 1 CBM ekstra
              let extraCBM = 0;
              if (length > 100) extraCBM++;
              if (width > 100) extraCBM++;
              if (height > 100) extraCBM++;

              let cbmToBuy = Math.max(cbmByVolume, cbmByWeight) + extraCBM;

              // Harga per CBM
              let cbmPrice = 1500000;
              let totalCBMPrice = cbmToBuy * cbmPrice;

              // Update tampilan hasil CBM
              document.getElementById("cbmResult").innerText = cbmRounded.toFixed(3);
              document.getElementById("cbmToBuy").innerText = cbmToBuy;

              // Tampilkan card CBM di HTML
              let cbmPriceCard = document.getElementById("cbmPriceCard");
              cbmPriceCard.innerHTML = `
                  <div class="card bg-light-primary mb-1">
                      <div class="card-body p-3">
                          <div class="row">
                              <div class="col-6">
                                  <h5 class="mb-0">Total CBM: ${cbmToBuy}</h5>
                              </div>
                              <div class="col-6 text-end">
                                  <h5 class="mb-0">Rp. ${totalCBMPrice.toLocaleString("id-ID")}</h5>
                              </div>
                          </div>
                      </div>
                  </div>
              `;

              // Update total harga
              updateTotalPrice();
          }

          function updateTotalPrice() {
            let totalPrice = 0;

            // Ambil harga CBM dari hasil perhitungan CBM
            let cbmToBuy = parseInt(document.getElementById("cbmToBuy").innerText) || 0;
            let cbmPrice = 1500000; // Harga per CBM
            totalPrice += cbmToBuy * cbmPrice;

            // Ambil harga layanan yang dicentang
            let selectedServices = document.querySelectorAll(".service-checkbox:checked");
            selectedServices.forEach(service => {
                let servicePrice = parseFloat(service.getAttribute("data-price"));
                totalPrice += servicePrice;
            });

            // Update tampilan total harga
            document.getElementById("totalPrice").innerText = `Rp. ${totalPrice.toLocaleString("id-ID")}`;

            // Simpan nilai ke dalam input hidden
            document.getElementById("cbmInput").value = cbmToBuy;
            document.getElementById("totalPriceInput").value = totalPrice;
        }

          // Pastikan layanan yang dicentang akan menampilkan harga
          function updateServices() {
            let selectedServices = document.querySelectorAll(".service-checkbox:checked");
            let servicePriceList = document.getElementById("servicePriceList");
            let selectedServicesInput = document.getElementById("selectedServicesInput");

            servicePriceList.innerHTML = ""; // Bersihkan daftar layanan
            let selectedServiceNames = []; // Array untuk layanan yang dipilih

            selectedServices.forEach(service => {
                let serviceName = service.value;
                let servicePrice = parseFloat(service.getAttribute("data-price"));

                selectedServiceNames.push(serviceName); // Simpan layanan ke array

                let formattedPrice = servicePrice.toLocaleString("id-ID");

                // Tambahkan card untuk setiap layanan yang dipilih
                servicePriceList.innerHTML += `
                    <div class="card bg-light-primary mb-1">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="mb-0">${serviceName}</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <h5 class="mb-0">Rp. ${formattedPrice}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Update input text dengan layanan yang dipilih
            selectedServicesInput.value = selectedServiceNames.join(", ");

            // **Tambahkan ini untuk update total harga setelah memilih layanan**
            updateTotalPrice();
        }


          // Pastikan setiap perubahan layanan juga mempengaruhi total harga
          document.querySelectorAll(".service-checkbox").forEach(checkbox => {
              checkbox.addEventListener("change", updateServices);
          });


        </script>
@endsection