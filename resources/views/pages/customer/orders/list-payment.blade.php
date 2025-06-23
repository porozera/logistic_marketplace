@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Payment History')
@section('styles')
<style>
.badge-status {
    min-width: 100px;
    display: inline-block;
    text-align: center;
}
</style>
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
                                      <th class="text-center"><small>No</small></th>
                                      <th class="text-center"><small>Asal</small></th>
                                      <th class="text-center"><small>Tujuan</small></th>
                                      <th class="text-center"><small>Tipe</small></th>
                                      <th class="text-center"><small>Moda</small></th>
                                      <th class="text-center"><small>Tanggal Pengiriman</small></th>
                                      <th class="text-center"><small>Total Harga</small></th>
                                      <th class="text-center"><small>Status</small></th>
                                      <th class="text-center"><small>Actions</small></th>
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
                                        <td class="text-center"><small>{{ $no++ }}</small></td>
                                        <td class="text-center"><small>{{ $userOrder->order->origin }}</small></td>
                                        <td class="text-center"><small>{{ $userOrder->order->destination }}</small></td>
                                        <td class="text-center"><small>{{ $userOrder->order->shipmentType }}</small></td>
                                        <td class="text-center"><small>{{ $userOrder->order->shipmentMode }}</small></td>
                                        @if ($userOrder->order?->getpickupDate() == "Tidak ada informasi tanggal")
                                            <td class="text-center"><small>{{ $userOrder->order?->getetd() }}</small></td>
                                        @else
                                            <td class="text-center"><small>{{ $userOrder->order?->getpickupDate() }}</small></td>
                                        @endif
                                        
                                        <td class="text-center"><small>Rp. {{ number_format($userOrder->totalPrice, 0, ',', '.') }}</small></td>
                                        
                                        <td class="text-center">
                                            @if ($userOrder['paymentStatus'] == "Belum Lunas")
                                                <span class="badge rounded-pill text-bg-warning badge-status">Belum Lunas</span>
                                            @elseif ($userOrder['paymentStatus'] == "Lunas")
                                                <span class="badge rounded-pill text-bg-success badge-status">Lunas</span>
                                            @else
                                                <span class="badge rounded-pill text-bg-danger badge-status">Canceled</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="">
                                                @if ($userOrder['paymentStatus'] == "Belum Lunas")
                                                    <a href="/payment/{{ $userOrder->payment_token }}" class="" title="Bayar">
                                                        <i class="ti ti-cash mt-0"></i> <small>Bayar</small>
                                                    </a>
                                                @else
                                                <a href="/invoice/{{ $userOrder->payment_token }}" class="" title="Lihat Invoice">
                                                    <i class="ti ti-file-text"></i> <small>Invoice</small>
                                                </a>
                                                @endif
                                            </div>
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
