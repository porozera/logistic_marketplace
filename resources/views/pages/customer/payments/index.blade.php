@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

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
                <h4 class="m-b-10">Detail Pemesanan</h4>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              </div>
                {{-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Home</li>
                </ul> --}}
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
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


      <form action="" method="POST">
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

                      <div id="priceCard"></div> 
                      
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
                        <select class="form-control" name="shipmentMode" id="shipmentMode">
                            <option value=""></option>
                            <option value="Laut">Parfum</option>
                            <option value="Darat">Binatang</option>
                        </select>                            
                        @error('shipmentMode') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
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
                                <input class="form-check-input" type="checkbox" value="{{ $item['serviceName'] }}" id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
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
                      <input type="text" name="telpNumber" class="form-control" placeholder="+62" value="{{ old('origin') }}">
                      @error('origin') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group mb-3">
                      <label class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="description" rows="4" placeholder="Deskripsi">{{ old('description') }}</textarea>
                      @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <a href="/payment/{{$offer['id']}}" class="btn btn-primary w-100">Bayar Sekarang</a> 
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

            function calculateCBM() {
                    // Ambil nilai input
                    let length = parseFloat(document.getElementById("length").value) || 0;
                    let width = parseFloat(document.getElementById("width").value) || 0;
                    let height = parseFloat(document.getElementById("height").value) || 0;
                    let weight = parseFloat(document.getElementById("weight").value) || 0;

                    // Konversi cm ke meter
                    let lengthM = length / 100;
                    let widthM = width / 100;
                    let heightM = height / 100;

                    // Hitung CBM
                    let cbm = lengthM * widthM * heightM;
                    let cbmRounded = Math.ceil(cbm * 1000) / 1000; // Dibulatkan ke atas pada 3 angka desimal

                    // Maksimum berat per CBM
                    let maxWeightPerCBM = 600;

                    // Hitung CBM yang harus dibeli
                    let cbmByVolume = Math.ceil(cbmRounded); // Minimal CBM berdasar volume
                    let cbmByWeight = Math.ceil(weight / maxWeightPerCBM); // Minimal CBM berdasar berat

                    // Ambil CBM terbesar antara keduanya
                    let cbmToBuy = Math.max(cbmByVolume, cbmByWeight);

                    // Tampilkan hasil
                    document.getElementById("cbmResult").innerText = cbmRounded.toFixed(3);
                    document.getElementById("cbmToBuy").innerText = cbmToBuy;

                    // Ambil harga per CBM dari backend
                    let pricePerCBM = {{ $offer['price'] }};

                    // Hitung total harga
                    let totalPrice = cbmToBuy * pricePerCBM;

                    // Format harga ke Rupiah
                    let formattedPrice = totalPrice.toLocaleString("id-ID");

                    // Update tampilan card harga
                    document.getElementById("priceCard").innerHTML = `
                        <div class="card bg-light-primary mb-1">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-0">Total ${cbmToBuy} CBM</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h5 class="mb-0">Rp. ${formattedPrice}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
        </script>
@endsection