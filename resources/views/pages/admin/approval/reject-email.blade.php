<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Permintaan Akun Ditolak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdf4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header {
            background-color: #d9534f;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            color: #ffffff;
            text-align: center;
        }

        .content {
            padding: 20px 0;
            line-height: 1.6;
            color: #333333;
        }

        .content strong {
            color: #d9534f;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888888;
            font-size: 13px;
        }

        .info-box {
            background-color: #fbe9e9;
            padding: 15px;
            border-left: 4px solid #d9534f;
            margin-top: 15px;
            border-radius: 4px;
        }

        .info-box p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Permintaan Akun Ditolak</h2>
    </div>
    <div class="content">
        <p>Halo <strong>{{ $companyName }}</strong>,</p>

        <p>Terima kasih telah mengajukan permintaan akun pada sistem kami. Setelah dilakukan peninjauan, kami mohon maaf karena <strong>permintaan akun Anda belum dapat disetujui</strong> saat ini.</p>

        <div class="info-box">
            <p>Alasan penolakan dapat disebabkan oleh data yang tidak lengkap atau tidak sesuai dengan ketentuan.</p>
        </div>

        <p>Jika Anda yakin telah mengisi data dengan benar atau ingin mengajukan kembali, silakan hubungi tim kami atau ajukan ulang melalui sistem.</p>

        <p>Kami menghargai minat Anda untuk bergabung dan berharap dapat bekerja sama di lain kesempatan.</p>

        <p>Salam hormat,<br><strong>Tim Admin</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Nama Aplikasi. Semua hak dilindungi.
    </div>
</div>
</body>
</html>
