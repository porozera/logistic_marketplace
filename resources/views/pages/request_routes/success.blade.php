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
        <div class="col-md-4 text-center col-xl-4">

        </div>
        <div class="col-md-4 text-center col-xl-4">
          <div class="card text-center">
            <div class="card-body">
              <h4 class="mb-2">Permintaan Berhasil Dikirim!</h4>
              <h7>Tunggu Penawaran sampai tanggal 20 Oktober 2024</h7>
              <h7>Silakan cek kotak pesan secara berkala</h7>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center col-xl-4">

        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-center col-xl-4">
            
        </div>
        <div class="col-md-4 text-center col-xl-4">
            <button class="btn btn-primary">Kembali</button>
        </div>
        <div class="col-md-4 text-center col-xl-4">
            
        </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
@endsection