@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Payment History')
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
                            <li class="breadcrumb-item" aria-current="page">Payment History</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12">
              <h4 class="m-b-10">Payment History</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="pc-dt-simple" style="min-width: 1200px;">
                                <thead>
                                    <tr>
                                      <th><small>No</small></th>
                                      <th><small>Asal</small></th>
                                      <th><small>Tujuan</small></th>
                                      <th><small>Tipe</small></th>
                                      <th><small>Moda</small></th>
                                      <th><small>Jenis Barang</small></th>
                                      <th><small>Berat</small></th>
                                      <th><small>Volume</small></th>
                                      <th><small>Tanggal Pengiriman</small></th>
                                      <th><small>Total Harga</small></th>
                                      <th><small>Status</small></th>
                                      <th><small>Actions</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userOrders->isEmpty())
                                    <tr>
                                        <td colspan="12" class="text-center">No Payment History</td>
                                    </tr>
                                    @else
                                    @php
                                       $no = ($userOrders->currentPage() - 1) * $userOrders->perPage() + 1
                                    @endphp
                                    @foreach ($userOrders as $userOrder)
                                    <tr>
                                        <td><small>{{ $no++ }}</small></td>
                                        <td><small>{{ $userOrder->order->origin }}</small></td>
                                        <td><small>{{ $userOrder->order->destination }}</small></td>
                                        <td><small>{{ $userOrder->order->shipmentType }}</small></td>
                                        <td><small>{{ $userOrder->order->shipmentMode }}</small></td>
                                        <td><small>{{ $userOrder->commodities }}</small></td>
                                        <td><small>{{ $userOrder->weight }} kg</small></td>
                                        <td><small>{{ $userOrder->volume }} CBM</small></td>
                                        <td><small>{{ $userOrder->order->shippingDate }}</small></td>
                                        <td><small>Rp. {{ number_format($userOrder->totalPrice, 0, ',', '.') }}</small></td>
                                        
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
                                            <a href="/payment/{{$userOrder->payment_token}}"><small>Bayar</small></a>
                                            @else
                                            {{-- <a href="" class="btn btn-icon btn-light-primary"><i class="ti ti-compass"></i></a> --}}
                                            <a href="/invoice/{{$userOrder->payment_token}}"><small>Invoice</small></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>                         
                            </table>  
                        </div>
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
