@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Review')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Order</a></li>
                            <li class="breadcrumb-item" aria-current="page">Daftar Ulasan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <h3 class="">Daftar Ulasan</h3>
            </div>
        </div>
        @foreach ($reviews as $item )
        <div class="row justify-content-center">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <div class="me-4">
                                    <img src="{{ $item->lsp->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                        alt="profile-lsp" 
                                        class="user-avtar border wid-35 rounded-circle">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="mb-0 fw-bold">{{ $item->lsp->companyName }}</h5>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-end align-items-center">
                                <a href="" class="btn btn-icon btn-light-primary"><i class="ti ti ti-edit"></i></a>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-12 d-flex justify-content-between">
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $item->ratingNumber ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    <span>({{ $item->ratingNumber }})</span>
                                </div>
                                <p class="mb-0">{{ $item->created_at }}</p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <p class="fw-bold text-primary">{{ $item->order->origin }}</p>
                                    <div class="bg-secondary mx-2 mb-3" style="width: 10px; height: 1px;"></div>
                                    <p class="fw-bold text-primary">{{ $item->order->destination }}</p>
                                    <p class="mx-2">|</p>
                                    <p class="fw-bold text-primary">{{ $item->order->shipmentType}}</p>
                                    <p class="mx-2">|</p>
                                    <p class="fw-bold text-primary">{{ $item->order->shipmentMode}}</p>
                                    <p class="mx-2">|</p>
                                    <p class="fw-bold text-primary">{{ $item->order->shipping_date_formatted}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>Komentar:</p>
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{$item->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $reviews->links('pagination::bootstrap-4') }}
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
@endsection