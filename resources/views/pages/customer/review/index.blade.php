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
                            <li class="breadcrumb-item" aria-current="page">Review</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center text-primary">Beri Ulasan</h4>
                        <br>
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
                                <textarea class="form-control" name="address" rows="4" placeholder="Tulis pengalaman Anda disini!">{{ old('address') }}</textarea>
                                @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                        </div>
                        <span class="text-muted small">*Bagikan pengalaman Anda dengan LSP ini, pastikan untuk menyebutan detail yang mungkin dapat membantu pengguna lain.</span>
                        <div class="row justify-content-end">
                            <div class="col-md-4 text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Ulasan</button>
                            </div>
                        </div>
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