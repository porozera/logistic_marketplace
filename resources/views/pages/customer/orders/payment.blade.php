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
                            <h4 class="m-b-10">Pembayaran</h4>
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
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Pemesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-6">
                                    <p>Asal :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$order['origin']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tujuan :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$order['destination']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tangal Muat :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$order['loading_date_formatted']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tangal Pengiriman :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$order['shipping_date_formatted']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Estimasi Tangal Tiba :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$order['estimation_date_formatted']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Berat Barang :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$userOrder['weight']}} Kg</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Volume :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$userOrder['volume']}} CBM</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Tipe Barang :</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p><b>{{$userOrder['commodities']}}</b></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Layanan yang dipilih :</p>
                                </div>
                                <div class="col-6 text-end">
                                    @if(!empty($userOrder->services))
                                    <p><b>{{ $userOrder->services }}</b></p>
                                    @else
                                        <p><b>Tidak ada layanan yang dipilih</b></p>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <h3 class="text-end text-primary">Rp. {{ number_format($userOrder['totalPrice'], 0, ',', '.')}}</h3>
                        </div>
                        <br>
                        <div class="row">
                            <button class="btn btn-primary text-center">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection