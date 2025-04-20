@extends('layouts.app')
@section('title', 'Manajemen Pesanan')
@section('content')
@php
    \Carbon\Carbon::setLocale('id');
@endphp

<div class="pc-container">
    <div class="pc-content">
        <h2 class="mb-4">Order Management</h2>

        @if($orders->isEmpty())
            <div class="alert alert-info">Belum ada kontainer yang dipesan.</div>
        @endif

        @foreach($orders as $order)
            <div class="card card-hover mb-3 shadow-sm p-3" style="border-radius: 10px">
                <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-4 d-flex align-items-center justify-content-start">
                                <h4 class="mb-0">No Offer : <span class="text-primary">{{$order->noOffer}}</span> </h4>
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-start">
                                @php
                                $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($order->loadingDate), false);
                                $daysLeft = ceil($daysLeft);
                                @endphp
                                @if ($daysLeft > 0)
                                <h4 class=" bg-primary text-light " style="border-radius: 30px; padding:5px">Muat dalam {{ $daysLeft }} hari</h4>
                                @elseif ($daysLeft == 0)
                                <h4 class=" bg-primary text-dark " style="border-radius: 30px; padding:5px">Muat Hari ini</h4>
                                @else
                                <h4 class=" bg-danger text-dark " style="border-radius: 30px; padding:5px">Lewat {{ abs($daysLeft) }} hari</h4>
                                @endif
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-end">
                                <h4 class="mb-0">ID : <span class="text-primary">{{$order->id}}</span> </h4>
                            </div>
                        </div>
                        <hr class="text-primary" style="border: 1px solid #007bff; border-radius: 5px;">
                        <div class="row align-items-center mt-3">
                            <div class="col-md-6 d-flex align-items-center justify-content-start">
                                <h5 class="mb-0 fw-bold">{{ $order->origin }}</h5>
                                <div class="d-flex align-items-center mx-4">
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <i class="ti ti-clock text-primary"></i>
                                    <h5 class="mb-0 mx-2 text-primary">{{ \Carbon\Carbon::parse($order->shippingDate)->diffInDays(\Carbon\Carbon::parse($order->estimationDate)) }} Hari</h5>
                                    <div class="bg-primary mx-2" style="width: 80px; height: 1px;"></div>
                                    <div class="rounded-circle bg-primary" style="width: 16px; height: 16px;"></div>
                                </div>
                                <h5 class="mb-0 fw-bold">{{ $order->destination }}</h5>
                            </div>
                            <div class="col-md-6  gap-2 text-end" style="display:flex; justify-content: flex-end">
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti {{ $order->shipmentMode == 'laut' ? 'ti-sailboat' : 'ti-truck-delivery' }} me-1"></i>
                                    {{ ucfirst($order->shipmentMode) }}
                                </button>
                                <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                    <i class="ti ti-box me-1"></i> {{ $order->shipmentType }}
                                </button>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-md-6 align-items-center justify-content-start d-flex">
                                <div style="display: block">
                                    <h5 class="mb-0">Tanggal Muat : </h5>
                                    <h5 class="mb-0 text-primary mt-2">{{ \Carbon\Carbon::parse($order->loadingDate)->translatedFormat('l, d F Y')}}</h5>
                                </div>
                                <div style="display: block" class="ms-4">
                                    <h5 class="mb-0">Tanggal Pengiriman : </h5>
                                    <h5 class="mb-0 text-primary mt-2">{{ \Carbon\Carbon::parse($order->shippingDate)->translatedFormat('l, d F Y')}}</h5>
                                </div>
                            </div>
                            <div class="col-md-6  gap-2 text-end" style="display:flex; justify-content: flex-end">
                                <a href=" {{route('order-management.showOffer', $order->id)}} " class="btn btn-primary" style="border-radius: 10px; width:250px">Lihat Detail</a>
                            </div>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
