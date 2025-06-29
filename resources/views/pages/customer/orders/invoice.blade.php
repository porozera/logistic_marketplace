@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Invoice')
@section('style')
{{-- <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        background-color: #f8f9fa;
        color: #333;
    }
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .header, .footer {
        text-align: center;
        margin-bottom: 20px;
    }
    /* .header h2 {
        font-size: 24px;
        margin-bottom: 5px;
        color: #007bff;
    }
    .header p {
        font-size: 14px;
        color: #666;
    } */
    .text-right {
        text-align: right;
    }
    table {
        width: 100%;
        line-height: 1.6;
        text-align: left;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table td {
        padding: 8px;
        vertical-align: top;
        border-bottom: 1px solid #ddd;
        width: 50%
    }
    table tr:last-child td {
        border-bottom: none;
    }
    .total {
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }
    .section-title {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    .footer p {
        font-size: 12px;
        color: #666;
    }
</style> --}}
<style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        .no-border {
            border: none;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
        }
        .red {
            color: red;
        }
    </style>
@endsection

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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Payment History</a></li>
                            <li class="breadcrumb-item" aria-current="page">Invoice</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center mb-3">
            <div class="col-6 text-end">
                <a href="{{ route('invoice.download', $userOrder->payment_token) }}" class="btn btn-success mt-3">
                    <i class="ti ti-file-download me-1 mt-2"></i> Download PDF
                </a>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <body>
                        <h4 class="text-center text-primary">INVOICE</h4>
                        <hr>
                        <table class="no-border" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border" style="width: 50%">
                                    <p class="mb-0">SentraLogiX<br>
                                    Jln Jaksa Agung No 56 Jakarta</p>
                                </td>
                                <td class="no-border" style="width: 50%">
                                    <p class="mb-0">No: {{ $userOrder->invoiceNumber}}<br>
                                    Tanggal: {{ $userOrder->getinvoicedate()}}</p>
                                </td>
                            </tr>
                        </table>

                        <table class="no-border mb-0" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p><strong>Ditujukan Kepada</strong><br>
                                {{ $userOrder->user->firstName}} {{ $userOrder->user->lastName}}<br>
                                {{ $userOrder->user->address}}</p>
                                </td>
                            </tr>
                        </table>
                        <table class="no-border mb-0" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Pengiriman</strong></p>
                                </td>
                            </tr>
                        </table>

                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center"><p class="mb-0">Asal</p></th>
                                    <th class="text-center"><p class="mb-0">Tujuan</p></th>
                                    <th class="text-center"><p class="mb-0">Tipe Pengiriman</p></th>
                                    <th class="text-center"><p class="mb-0">Mode Pengiriman</p></th>
                                    <th class="text-center"><p class="mb-0">Berangkat</p></th>
                                    <th class="text-center"><p class="mb-0">Sampai</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->origin}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->destination}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->shipmentType}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->shipmentMode}}</p></td>
                                    @if(!empty($userOrder->order->pickupDate))
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->getpickupdate()}}</p></td>
                                    @elseif(!empty($userOrder->order->departureDate))
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->getdeparturedate()}}</p></td>
                                    @else
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->getetd()}}</p></td>
                                    @endif

                                    @if(!empty( $userOrder->order->arrivalDate))
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->getarrivaldate()}}</p></td>
                                    @else
                                    <td class="text-center"><p class="mb-0">{{ $userOrder->order->geteta()}}</p></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        
                        @if ($userOrder->order->shipmentType == 'FCL')
                        <table class="no-border mb-0 mt-3" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Kontainer</strong></p>
                                </td>
                            </tr>
                        </table>

                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center"><p class="mb-0">No</p></th>
                                    <th class="text-center"><p class="mb-0">Kontainer</p></th>
                                    <th class="text-center"><p class="mb-0">Muatan</p></th>
                                    <th class="text-center"><p class="mb-0">Berat</p></th>
                                    <th class="text-center"><p class="mb-0">Volume</p></th>
                                    <th class="text-center"><p class="mb-0">Qty</p></th>
                                    <th class="text-center"><p class="mb-0">Harga</p></th>
                                </tr>
                            </thead>
                            <?php
                            $noItem = 1;
                            $totalPrice = 0; 
                            $totalVolume = 0; 
                            ?>
                            <tbody>
                                @foreach ($items as $item )
                                <tr>
                                    <td class="text-center"><p class="mb-0">{{ $noItem}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $offer->container->name }}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $item->commodities}}</p></td>
                                    <td class="text-end"><p class="mb-0">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                    <td class="text-end"><p class="mb-0">{{ (int) $item->volume }} CBM</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->qty}}</p></td>
                                    <td class="text-end"><p class="mb-0">Rp. {{ number_format($item->price * $item->volume * $item->qty, 0, ',', '.') }}</p></td>
                                </tr>
                                <?php
                                $noItem++;
                                $totalPrice += $item->price * $item->volume * $item->qty; 
                                $totalVolume += $item->volume; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="6"><p class="mb-0">Total</p></th>
                                    <th class="text-end"><p class="mb-0">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-3" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Layanan</strong></p>
                                </td>
                            </tr>
                        </table>
                        @else
                        <table class="no-border mb-0 mt-3" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Muatan</strong></p>
                                </td>
                            </tr>
                        </table>

                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center"><p class="mb-0">No</p></th>
                                    <th class="text-center"><p class="mb-0">Muatan</p></th>
                                    <th class="text-center"><p class="mb-0">Panjang</p></th>
                                    <th class="text-center"><p class="mb-0">Lebar</p></th>
                                    <th class="text-center"><p class="mb-0">Tinggi</p></th>
                                    <th class="text-center"><p class="mb-0">Qty</p></th>
                                    <th class="text-center"><p class="mb-0">Berat</p></th>
                                    <th class="text-center"><p class="mb-0">Volume</p></th>
                                    <th class="text-center"><p class="mb-0">Harga</p></th>
                                </tr>
                            </thead>
                            <?php
                            $noItem = 1;
                            $totalPrice = 0; 
                            $totalVolume = 0; 
                            ?>
                            <tbody>
                                @foreach ($items as $item )
                                <tr>
                                    <td class="text-center"><p class="mb-0">{{ $noItem}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $item->commodities}}</p></td>
                                    <td class="text-end"><p class="mb-0">{{ (int) $item->length}} cm</p></td>
                                    <td class="text-end"><p class="mb-0">{{ (int) $item->width}} cm</p></td>
                                    <td class="text-end"><p class="mb-0">{{ (int) $item->height}} cm</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->qty}}</p></td>
                                    <td class="text-end"><p class="mb-0">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                    <td class="text-end"><p class="mb-0">{{ ceil($item->volume) }} CBM</p></td>
                                    <td class="text-end"><p class="mb-0">Rp. {{ number_format($item->price, 0, ',', '.') }}</p></td>
                                </tr>
                                <?php
                                $noItem++;
                                $totalPrice += $item->price; 
                                $totalVolume += $item->volume; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="8"><p class="mb-0">Total</p></th>
                                    <th class="text-end"><p class="mb-0">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-3" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Layanan</strong></p>
                                </td>
                            </tr>
                        </table>
                        @endif
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center"><p class="mb-0">No</p></th>
                                    <th class="text-center"><p class="mb-0">Layanan</p></th>
                                    <th class="text-center"><p class="mb-0">Deskripsi</p></th>
                                    <th class="text-center"><p class="mb-0">Harga</p></th>
                                </tr>
                            </thead>
                            <?php
                            $noService = 1;
                            $totalServicePrice = 0; 
                            ?>
                            <tbody>
                                @foreach ($services as $item )
                                <tr>
                                    <td class="text-center"><p class="mb-0">{{ $noService}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $item->service->serviceName}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ $item->service->description}}</p></td>
                                    <td class="text-end"><p class="mb-0">Rp. {{ number_format($item->service->price, 0, ',', '.') }}</p></td>
                                </tr>
                                </tr>
                                <?php
                                $noService++;
                                $totalServicePrice += $item->service->price; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="3"><p class="mb-0">Total</p></th>
                                    <th class="text-end"><p class="mb-0">Rp. {{ number_format($totalServicePrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-4" style="margin-bottom: 20px;">
                            <tr>
                                <td class="no-border text-end">
                                <h5 class="mb-0"><strong>Total Tagihan dengan PPn (11%): Rp. {{ number_format($userOrder->totalPrice+($userOrder->totalPrice*11/100), 0, ',', '.') }}</strong></h5>
                                </td>
                            </tr>
                        </table>

                        <br><br>

                        <table class="no-border" style="margin-top: 30px;">
                            <tr>
                                <td class="no-border"></td>
                                <td class="no-border text-center">
                                    <img src=" {{ asset('images/Logo_SentraLogiX.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
                                </td>
                            </tr>
                        </table>

                    </body>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection