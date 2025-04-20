@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Detail Order')
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
                            <li class="breadcrumb-item" aria-current="page">Detail Order</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                @if(session('success'))
                <script>
                    Swal.fire({
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
                @endif
            </div>
        </div>
        @if ($review == 0 && $userOrder->order->status == 'selesai')
        {{-- @if ($review == 0) --}}
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <div class="card card-hover">
                    <div class="card-body">
                        <h4 class="text-center text-primary">Beri Ulasan</h4>
                        <br>
                        <form action="/review/create/perform" method="post" id="reviewAddForm">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="form-group text-center mb-3">
                                    <input type="hidden" name="ratingNumber" id="ratingNumber" value="{{ old('ratingNumber', 0) }}">
                                
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star fa-2x star-rating" data-value="{{ $i }}" style="cursor: pointer; color: #ccc;"></i>
                                    @endfor
                                
                                    @error('ratingNumber') 
                                        <p class="text-danger text-xs pt-1"> {{$message}} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="description" rows="4" placeholder="Tulis pengalaman Anda disini!">{{ old('description') }}</textarea>
                                    @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                </div>
                            </div>
                            <input type="number" name="lsp_id" class="form-control" value="{{ $userOrder->order->lsp_id }}" hidden>
                            <input type="number" name="order_id" class="form-control" value="{{ $userOrder->order->id }}" hidden>
                            <input type="number" name="userOrder_id" class="form-control" value="{{ $userOrder->id }}" hidden>
                            <span class="text-muted small">*Bagikan pengalaman Anda dengan LSP ini, pastikan untuk menyebutan detail yang mungkin dapat membantu pengguna lain.</span>
                            <div class="row">
                                <div class="col-12">
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
                            <div class="row justify-content-end">
                                <div class="col-md-4 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Ulasan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif  
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12 col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div id='map' style='width: 100%; height: 600px;'></div>
                        @php
                            $lng = $location->longitude ?? 0;
                            $lat = $location->latitude ?? 0;
                        @endphp

                        <script>
                            mapboxgl.accessToken = 'pk.eyJ1IjoiYXVmYXJudWdyYXRhbWFwcyIsImEiOiJjbTkxZ2xkdW4wMHJpMmxvZTl1Z25zZWlrIn0.2pWYizs2qnqxUz6PeW7d-w';

                            const map = new mapboxgl.Map({
                                container: 'map',
                                style: 'mapbox://styles/aufarnugratamaps/cm91i1s4m00al01s43z35bik2',
                                center: [{{ $lng }}, {{ $lat }}],
                                zoom: 10
                            });

                            window.addEventListener('resize', () => map.resize());

                            // Buat elemen HTML untuk marker
                            const el = document.createElement('div');
                            el.className = 'custom-marker';
                            el.style.backgroundImage = "url('{{ asset('images/truck-icon3.png') }}')";
                            el.style.width = '50px';
                            el.style.height = '50px';
                            el.style.backgroundSize = 'cover';

                            // Tambahkan marker dengan ikon custom
                            new mapboxgl.Marker(el)
                                .setLngLat([{{ $lng }}, {{ $lat }}])
                                .setPopup(new mapboxgl.Popup().setHTML(`<strong>Location:</strong> {{ $location->currentLocation }}<br><strong>Vehicle:</strong> {{ $location->currentVehicle }}`))
                                .addTo(map);
                        </script>

                        
                    </div>
                </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Detail Order</h4>
                            <div class="mb-2">
                                Penyedia Jasa Logistik:
                                <span class="fw-bold d-inline">{{ $userOrder->order->lspName }}</span>
                            </div>
            
                            <div class="mb-3">
                                <h5 class="fw-bold text-primary d-inline">ID: </h5>
                                <h5 class="text-primary d-inline">{{ $userOrder->order->noOffer }}</h5>
                            </div>
            
                            <div class="row mb-2">
                                <div class="col">Mode Pengiriman</div>
                                <div class="col text-end">
                                    {{-- <i class="ti {{ $offer['shipmentMode'] == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1 text-primary"></i> --}}
                                    @if ($userOrder->order->shipmentMode == 'D2D')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> Door to Door    
                                    @elseif ($userOrder->order->shipmentMode == 'D2P')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> Door to Port
                                    @elseif ($userOrder->order->shipmentMode == 'P2D')
                                    <i class="ti ti-truck-delivery text-primary me-1"></i> Port to Door   
                                    @elseif ($userOrder->order->shipmentMode == 'P2P')
                                    <i class="ti ti-sailboat text-primary me-1"></i> Port to Port
                                    @endif
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">Tipe Pengiriman</div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-success rounded-pill">
                                        {{ $userOrder->order->shipmentType == 'LCL' ? 'Less Container Load' : 'Full Container Load' }}
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <strong>Alamat Tujuan:</strong> 
                                <span class="text-primary">{{ $userOrder->order->address }}</span>
                            </div>
                            <hr>
            
                            <h5 class="mb-1">Asal Pengiriman</h5>
                            <p class="text-primary">{{ $userOrder->order->origin }}</p>
            
                            <h5 class="mb-1">Tujuan Pengiriman</h5>
                            <p class="text-primary">{{ $userOrder->order->destination }}</p>
            
                            <div class="row mb-3">
                                <div class="col">
                                    <h5 class="mb-1">Tanggal Muat Barang</h5>
                                    <p class="text-primary">{{ $userOrder->order->loading_date_formatted }}</p>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="col">
                                    <h5 class="mb-1">Tanggal Pengiriman</h5>
                                    <p class="text-primary">{{ $userOrder->order->shipping_date_formatted }}</p>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col">
                                    <h5 class="mb-1">Estmasi Tanggal Tiba</h5>
                                    <p class="text-primary">{{ $userOrder->order->estimation_date_formatted }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Detail LSP</h4>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Detail Truck</h4>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Detail Container</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4>Tracking Order</h4>
                            <i class="ti ti-map-pin text-danger ms-2 mb-2"></i>
                        </div>
                        @php
                            $maxCount = $tracking->count() - 1;
                            $count = 0;
                        @endphp
                        @foreach ($tracking as $item)
                        <div class="row">
                            <div class="col-2">
                                @if ($count != 0)
                                <p class="mb-1 text-muted">{{$item->created_at->format('d M Y H:i')}}</p>
                                @else
                                <p class="mb-1 fw-medium text-primary">{{$item->created_at->format('d M Y H:i')}}</p>
                                @endif
                            </div>
                            <div class="col-1">
                                @if ($count != 0)
                                <div class="rounded-circle bg-secondary mx-auto" style="width: 16px; height: 16px;"></div>
                                @else
                                <div class="rounded-circle bg-primary mx-auto" style="width: 16px; height: 16px;"></div>
                                @endif
                                @if ($count != $maxCount)
                                <div class="bg-secondary mx-auto" style="width: 1px; height: 80px;"></div>
                                @endif
                                
                            </div>
                            <div class="col-6">
                                @if ($count != 0)
                                <p class="mb-1 text-muted">{{$item->description}}</p>
                                @else
                                <p class="mb-1 fw-medium text-primary">{{$item->description}}</p>
                                @endif

                                @if ($count != 0)
                                <p class="mb-1 text-muted">{{$item->currentLocation}} ({{$item->currentVehicle}})</p>
                                @else
                                <p class="mb-1  text-primary">{{$item->currentLocation}} ({{$item->currentVehicle}})</p>
                                @endif
                            </div>                            
                            <div class="col-3 text-end text-muted">
                                <span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp 
                        @endforeach
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
                        Apakah Anda yakin mengirim ulasan ini?
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
                document.getElementById('reviewAddForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const stars = document.querySelectorAll('.star-rating');
                const ratingInput = document.getElementById('ratingNumber');
        
                stars.forEach((star) => {
                    star.addEventListener('click', function () {
                        const rating = this.getAttribute('data-value');
                        ratingInput.value = rating;
        
                        // update UI warna bintang
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= rating) ? '#f39c12' : '#ccc';
                        });
                    });
        
                    // Tambahan hover effect (opsional)
                    star.addEventListener('mouseover', function () {
                        const hoverRating = this.getAttribute('data-value');
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= hoverRating) ? '#f39c12' : '#ccc';
                        });
                    });
        
                    star.addEventListener('mouseout', function () {
                        const currentRating = ratingInput.value;
                        stars.forEach(s => {
                            s.style.color = (s.getAttribute('data-value') <= currentRating) ? '#f39c12' : '#ccc';
                        });
                    });
                });
        
                // Inisialisasi jika sudah ada nilai sebelumnya
                const initRating = ratingInput.value;
                stars.forEach(s => {
                    s.style.color = (s.getAttribute('data-value') <= initRating) ? '#f39c12' : '#ccc';
                });
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
@endsection