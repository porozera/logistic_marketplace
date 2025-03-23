@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Daftar Pemesanan')
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
                            <li class="breadcrumb-item" aria-current="page">Daftar Pemesanan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
              <h3 class="m-b-10">Daftar Pemesanan</h3>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover" id="pc-dt-simple">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Asal</th>
                                  <th>Tujuan</th>
                                  <th>Tipe Pengiriman</th>
                                  <th>Moda Pengiriman</th>
                                  <th>Tanggal Pengiriman</th>
                                  <th>Jenis Barang</th>
                                  <th>Berat</th>
                                  <th>Volume</th>
                                  <th>Total Harga</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                   $no = ($userOrders->currentPage() - 1) * $userOrders->perPage() + 1
                                @endphp
                                @foreach ($userOrders as $userOrder)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $userOrder->order->origin }}</td>
                                    <td>{{ $userOrder->order->destination }}</td>
                                    <td>{{ $userOrder->order->shipmentType }}</td>
                                    <td>{{ $userOrder->order->shipmentMode }}</td>
                                    <td>{{ $userOrder->order->shippingDate }}</td>
                                    <td>{{ $userOrder->commodities }}</td>
                                    <td>{{ $userOrder->weight }} kg</td>
                                    <td>{{ $userOrder->volume }} CBM</td>
                                    <td>Rp. {{ number_format($userOrder->totalPrice, 0, ',', '.') }}</td>
                                    
                                    <td>
                                        @if ($userOrder['paymentStatus'] == "Belum Lunas")
                                        <span class="badge rounded-pill text-bg-danger">Belum Lunas</span>
                                        @else
                                        <span class="badge rounded-pill text-bg-success">Lunas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($userOrder['paymentStatus'] == "Belum Lunas")
                                        {{-- <a href="" class="btn btn-icon btn-light-warning"><i class="ti ti-cash"></i></a> --}}
                                        <a href="/payment/{{$userOrder->id}}">Bayar</a>
                                        @else
                                        {{-- <a href="" class="btn btn-icon btn-light-primary"><i class="ti ti-compass"></i></a> --}}
                                        <a href="">Track</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>                         
                        </table>  
                        <div class="d-flex justify-content-center mt-4">
                            {{ $userOrders->links('pagination::bootstrap-4') }}
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
