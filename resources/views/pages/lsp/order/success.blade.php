@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title','Success')
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
              <img src="{{ asset('template/mantis/dist/assets/images/success-img.svg') }}">
              <br>
              <br>
              <h4 class="mb-2">Pembayaran Berhasil</h4>
              <h7>Terima kasih atas pembayaran anda!</h7>
              <hr>

              <div class="row">
                <div class="col-md-6 text-start">
                  <p>ID Pemesanan :</p>
                </div>
                <div class="col-md-6 text-end">
                  <p class="text-primary fw-bold">{{$orderItem->noOffer}}</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 text-start">
                  <p>Jumlah Pembayaran :</p>
                </div>
                <div class="col-md-6 text-end">
                  <p class="text-primary fw-bold">Rp. {{ number_format($userOrderItem['totalPrice'], 0, ',', '.')}}</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 text-start">
                  <p>Tanggal Pembayaran :</p>
                </div>
                <div class="col-md-6 text-end">
                  <p class="text-primary fw-bold">{{$userOrderItem->updated_at}}</p>
                </div>
              </div>

              <hr>
              <div class="row">
                <a href="/request-routes" class="btn btn-primary">Track Order</a>
              </div>
            <div class="col-md-4 text-center col-xl-4">

            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
@endsection
