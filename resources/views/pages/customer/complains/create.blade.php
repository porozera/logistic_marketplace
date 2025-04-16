@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Make a Complain')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Complains</a></li>
                            <li class="breadcrumb-item" aria-current="page">Make a Complain</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Make a Complain</h3>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/complain/create/perform" method="POST" id="complainAddForm">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label class="form-label">Header</label>
                                <input type="text" name="header" class="form-control" placeholder="Contoh: Barang belum sampai" value="{{ old('header') }}">
                                @error('header') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Jelaskan masalah yang Anda alami...">{{ old('description') }}</textarea>
                                @error('description') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                            <p class="text-muted">
                                *Silakan isi formulir di atas untuk menyampaikan keluhan atau masukan Anda terkait layanan kami. Tim kami akan segera meninjau dan memberikan tanggapan secepat mungkin.
                            </p>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}" hidden>
                            <input type="number" name="user_id" class="form-control" value="{{ $user->id }}" hidden>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Kirim Complain</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
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
                        Apakah Anda yakin membuat komplain ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Kirim Complain</button>
                    </div>
                </div>
            </div>
        </div>

        
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('complainAddForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        </script>
        <script>
            setTimeout(function () {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); 
                }
            }, 5000);
        </script>
@endsection