<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        td, th {
            border: 1px solid black;
            padding: 3px 4px;
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
</head>
<body>
    <div class="card">
                    <div class="card-body">
                        <body>
                        <h2 class="text-center text-primary">SentraLogiX</h2>
                        <h4 class="text-center text-primary">INVOICE</h4>
                        <hr>
                        <table class="no-border" style="margin-bottom: 5px;">
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

                        <table class="no-border mb-0" style="margin-bottom: 5px;">
                            <tr>
                                <td class="no-border">
                                <p><strong>Ditujukan Kepada</strong><br>
                                {{ $userOrder->user->firstName}} {{ $userOrder->user->lastName}}<br>
                                {{ $userOrder->user->address}}</p>
                                </td>
                            </tr>
                        </table>
                        <table class="no-border mb-0" style="margin-bottom: 5px;">
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
                                    <th class="text-center"><p class="mb-0">ETD</p></th>
                                    <th class="text-center"><p class="mb-0">ETA</p></th>
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
                        <table class="no-border mb-0 mt-3" style="margin-bottom: 5px;">
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
                                    <td class="text-center"><p class="mb-0">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->volume }} CBM</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->qty}}</p></td>
                                    <td class="text-center"><p class="mb-0">Rp. {{ number_format($item->price * $item->volume * $item->qty, 0, ',', '.') }}</p></td>
                                </tr>
                                <?php
                                $noItem++;
                                $totalPrice += $item->price * $item->volume * $item->qty; 
                                $totalVolume += $item->volume; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="6"><p class="mb-0">Total</p></th>
                                    <th class="text-center"><p class="mb-0">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-3" style="margin-bottom: 5px;">
                            <tr>
                                <td class="no-border">
                                <p class="mb-0"><strong>Detail Layanan</strong></p>
                                </td>
                            </tr>
                        </table>
                        @else
                        <table class="no-border mb-0 mt-3" style="margin-bottom: 5px;">
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
                                    <td class="text-center"><p class="mb-0">{{ $item->commodities}}</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->length}} cm</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->width}} cm</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->height}} cm</p></td>
                                    <td class="text-center"><p class="mb-0">{{ number_format($item->weight, 0, ',', '.') }} kg</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->volume }} CBM</p></td>
                                    <td class="text-center"><p class="mb-0">{{ (int) $item->qty}}</p></td>
                                    <td class="text-center"><p class="mb-0">Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</p></td>
                                </tr>
                                <?php
                                $noItem++;
                                $totalPrice += $item->price * $item->qty; 
                                $totalVolume += $item->volume; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="8"><p class="mb-0">Total</p></th>
                                    <th class="text-center"><p class="mb-0">Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-3" style="margin-bottom: 5px;">
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
                                    <td class="text-center"><p class="mb-0">Rp. {{ number_format($item->service->price, 0, ',', '.') }}</p></td>
                                </tr>
                                </tr>
                                <?php
                                $noService++;
                                $totalServicePrice += $item->service->price; 
                                ?>
                                @endforeach
                                <tr>
                                    <th class="text-center" colspan="3"><p class="mb-0">Total</p></th>
                                    <th class="text-center"><p class="mb-0">Rp. {{ number_format($totalServicePrice, 0, ',', '.') }}</p></th>
                                </tr>
                            </tbody>
                        </table>

                        <table class="no-border mb-0 mt-4" style="margin-bottom: 20px; width: 100%;">
                            <tr>
                                <td class="no-border" style="width: 60%"></td>
                                <td class="no-border text-center" style="width: 40%; text-align: right;">
                                    <h3 class="mb-0"><strong>Total Tagihan: Rp. {{ number_format($userOrder->totalPrice, 0, ',', '.') }}</strong></h3>
                                </td>
                            </tr>
                        </table>

                        <br><br>

                        {{-- <table class="no-border" style="margin-top: 30px;">
                        <tr>
                            <td class="no-border"></td>
                            <td class="no-border text-center">
                                <img src="{{ public_path('images/Logo_SentraLogiX.png') }}" alt="Logo" style="height: 50px;">
                            </td>
                        </tr>
                        </table> --}}

                    </body>
                    </div>
                </div>
</body>
</html>
