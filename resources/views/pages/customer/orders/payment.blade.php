@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Payment')
@section('content')
<div class="pc-container">
    <div class="pc-content">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Offer Detail</a></li>
                            <li class="breadcrumb-item" aria-current="page">Payment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h4 class="m-b-10">Payment</h4>
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Pemesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Asal</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$order['origin']}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Tujuan</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$order['destination']}}</p>
                                </div>
                            </div>
                            @if (!empty($order->pickupDate))
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Tangal Muat Barang</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$order->getpickupDate()}}</p>
                                </div>
                            </div>   
                            @endif
                            
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Tanggal Berangkat (ETD)</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$order->getEtd()}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Tanggal Tiba (ETA)</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$order->geteta()}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Tipe Muatan</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$itemName}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Total Berat</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{ number_format($totalWeight, 0, ',', '.') }} kg</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Total Volume</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                    <p>{{$totalVolume}} CBM</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p class="">Layanan yang dipesan</p>
                                </div>
                                <div class="col-1">
                                    <p class="">:</p>
                                </div>
                                <div class="col-6 text-start text-primary">
                                   @if(!$services->isEmpty())
                                        <p>{{ $serviceNames }}</p>
                                    @else
                                        <p>Tidak ada layanan yang dipilih</p>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <h6 class="text-end text-gray-500">Total</h6>
                        </div>
                        <div class="row">
                            <h4 class="text-end text-primary">Rp. {{ number_format($userOrder['totalPrice'], 0, ',', '.')}}</h4>
                        </div>
                        <br>
                        <div class="row">
                            <button class="btn btn-primary text-center" id="pay-button">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
          // SnapToken acquired from previous step
          snap.pay('{{$userOrder->snap_token}}', {
            // Optional
            onSuccess: function(result){
              window.location.href = '{{ route('payment.success', ['token'=> $userOrder->payment_token]) }}';
            },
            // Optional
            onPending: function(result){
              window.location.href = '{{ route('payment.failed') }}';
            },
            // Optional
            onError: function(result){
                window.location.href = '{{ route('payment.failed') }}';
            },
            onClose: function() {
                 console.log("Snap popup closed by user.");
            }
          });
        };
      </script>
@endsection