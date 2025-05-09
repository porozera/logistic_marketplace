<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
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
        .header h2 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #007bff;
        }
        .header p {
            font-size: 14px;
            color: #666;
        }
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
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .footer p {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>INVOICE</h2>
            <p class="">SentraLogiX |  Jl. Telekomunikasi No. 1, Bandung Terusan Buahbatu | 08128035211</p>
        </div>
        <hr>
        <table>
            <tr>
                <td><strong>ID Penawaran:</strong></td>
                <td class="text-right">{{ $userOrder->order->noOffer }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pembayaran:</strong></td>
                <td class="text-right">{{ $userOrder->created_at->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td><strong>Status Pembayaran:</strong></td>
                <td class="text-right">{{ $userOrder->paymentStatus }}</td>
            </tr>
        </table>
        <div class="section-title">Detail Pengiriman</div>
        <table>
            <tr>
                <td><strong>Nama Penyedia Jasa:</strong></td>
                <td class="text-right">{{ $userOrder->order->lspName }}</td>
            </tr>
            <tr>
                <td><strong>Asal:</strong></td>
                <td class="text-right">{{ $userOrder->order->origin }}</td>
            </tr>
            <tr>
                <td><strong>Tujuan:</strong></td>
                <td class="text-right">{{ $userOrder->order->destination }}</td>
            </tr>
            <tr>
                <td><strong>Tipe Pengiriman:</strong></td>
                <td class="text-right">{{ $userOrder->order->shipmentType }}</td>
            </tr>
            <tr>
                <td><strong>Mode Pengiriman:</strong></td>
                <td class="text-right">{{ $userOrder->order->shipmentMode }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pengiriman:</strong></td>
                <td class="text-right">{{ \Carbon\Carbon::parse($userOrder->order->shippingDate)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td><strong>Alamat Pengiriman:</strong></td>
                <td class="text-right">{{ $userOrder->order->address }}</td>
            </tr>
        </table>
        <div class="section-title">Detail Barang</div>
        <table>
            <tr>
                <td><strong>Jenis Barang:</strong></td>
                <td class="text-right">{{ $userOrder->commodities }}</td>
            </tr>
            <tr>
                <td><strong>Volume:</strong></td>
                <td class="text-right">{{ $userOrder->volume }} CBM</td>
            </tr>
            <tr>
                <td><strong>Berat:</strong></td>
                <td class="text-right">{{ $userOrder->weight }} Kg</td>
            </tr>
        </table>
        <div class="section-title">Total Pembayaran</div>
        <table>
            <tr>
                <td><strong>Total:</strong></td>
                <td class="text-right total">Rp {{ number_format($userOrder->totalPrice, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>
</html>
