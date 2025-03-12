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
                <h4 class="m-b-10">Cari Rute</h4>
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
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-md-12 col-xl-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="origin" class="form-control" placeholder="Kota Asal" value="{{ old('origin') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="destination" class="form-control" placeholder="Kota Tujuan" value="{{ old('destination') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="shippingDate" class="form-control" placeholder="Tanggal Pengiriman" value="{{ old('shippingDate') }}">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="shipmentType" id="shipmentType">
                            <option class="form-control" value="FCL">FCL</option>
                            <option class="form-control" value="LCL">LCL</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Cari</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        
        {{-- Kotak filter --}}
        <div class="col-3">
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
                    <div class="row">
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" id="btnrdo1" name="btn_radio1" checked> 
                            <label class="btn btn-outline-primary" for="btnrdo1">Murah</label> 

                            <input type="radio" class="btn-check" id="btnrdo3" name="btn_radio1"> 
                            <label class="btn btn-outline-primary" for="btnrdo3">Cepat</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5>Layanan</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Asuransi
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                          Tempat penyimpanan
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                          Barang pecah belah
                        </label>
                    </div>
                    <hr>

                    <h5>Harga Maksimal</h5>
                    <input type="text" name="origin" class="form-control" placeholder="Rp." value="{{ old('origin') }}">
                    <hr>

                    <h5>Waktu Maksimal</h5>
                    <input type="date" name="origin" class="form-control" placeholder="Rp." value="{{ old('origin') }}">
                    <hr>

                    <div class="row">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Filter</button>
                    </div>
                </div>
            </div>
        </div>
{{-- End Kotak filter --}}

{{-- Card Offer --}}
        <div class="col-9">
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
                                <h5 class="mb-0 fw-bold">Pos Logistik Indonesia</h5>
                                <i class="fas fa-star text-warning"></i>
                                <h5 class="mb-0 fw-bold">5.0</h5>
                            </div>
                        </div>
            
                        <div class="col-md-4 d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i> 20'ST
                            </button>
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-alarm me-1"></i> 7 Hari
                            </button>                                                  
                        </div>
            
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn btn-icon btn-light-primary">
                                <i class="ti ti-copy"></i>
                            </button>
                        </div>
                    </div> 

                    <br>

                    <div class="row align-items-center">
                        <div class="col-md-12 text-end mt-2">
                            <h3 class="text-primary fw-bold">Rp 3.000.000</h3>
                        </div>
                    </div>
            
                    <div class="row align-items-center">
                        <div class="col-md-10 d-flex align-items-center justify-content-start mt-2">
                            <h4><b>Jakarta</b></h4>                      
                            <div class="d-flex align-items-center mx-4">
                                <div class="rounded-circle border border-2 border-primary" style="width: 16px; height: 16px;"></div>
                                <div class="bg-primary mx-2" style="width: 96px; height: 4px;"></div>
                                <h5 class="mb-0 fw-bold text-primary">5 Hari</h5>
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center ms-2" style="width: 16px; height: 16px;">
                                    <i class="fas fa-ship text-white" style="font-size: 10px;"></i>
                                </div>
                                <div class="bg-primary mx-2" style="width: 96px; height: 4px;"></div>
                                <div class="rounded-circle border border-2 border-primary" style="width: 16px; height: 16px;"></div>
                            </div>
                            <h4><b>Padang</b></h4> 
                        </div>
                        <div class="col-md-2 text-end mt-2">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal">Lihat Detail</button>
                        </div>
                    </div>                        
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