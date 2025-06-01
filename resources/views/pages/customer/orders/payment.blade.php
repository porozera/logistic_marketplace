@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Pembayaran')
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Pemesanan</a></li>
                            <li class="breadcrumb-item" aria-current="page">Pembayaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <h4 class="m-b-10">Pembayaran</h4>
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Pemesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-6">
                                    <p>Asal :</p>
                                </div>
                                <div class="col-6 ">
                                    <p><b>{{$order['origin']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tujuan :</p>
                                </div>
                                <div class="col-6 ">
                                    <p><b>{{$order['destination']}}</b></p>
                                </div>
                            </div>
                            @if (!empty($order->pickupAddress))
                            <div class="row">
                                <div class="col-6">
                                    <p>Tangal Muat Barang:</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$order->getpickupDate()}}</b></p>
                                </div>
                            </div>   
                            @endif
                            
                            <div class="row">
                                <div class="col-6">
                                    <p>Esitmated Time Departure :</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$order->getEtd()}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Estimated Time Arrival :</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$order->geteta()}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tipe Muatan :</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$itemName}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Total Berat :</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$totalWeight}} Kg</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Total Volume :</p>
                                </div>
                                <div class="col-6">
                                    <p><b>{{$totalVolume}} CBM</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Layanan yang dipilih :</p>
                                </div>
                                <div class="col-6">
                                   @if(!$services->isEmpty())
                                        <p><b>{{ $serviceNames }}</b></p>
                                    @else
                                        <p><b>Tidak ada layanan yang dipilih</b></p>
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
              /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                window.location.href = '{{ route('payment.failed') }}';
            }
          });
        };
      </script>
@endsection