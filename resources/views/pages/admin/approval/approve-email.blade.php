<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akun Anda Telah Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
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
            background-color: #0056b3;
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
            color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888888;
            font-size: 13px;
        }

        .info-box {
            background-color: #f1f5ff;
            padding: 15px;
            border-left: 4px solid #0056b3;
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
        <h2>Permintaan Akun Disetujui</h2>
    </div>
    <div class="content">
        <p>Halo <strong>{{ $companyName }}</strong>,</p>

        <p>Permintaan akun Anda pada sistem kami telah <strong>disetujui</strong>. Berikut ini adalah informasi login Anda:</p>

        <div class="info-box">
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <p>Silakan gunakan kredensial ini untuk login ke dalam sistem kami. Kami menyarankan Anda untuk mengganti password setelah login pertama demi keamanan akun Anda.</p>

        <p>Terima kasih telah bergabung dengan kami.</p>

        <p>Salam hormat,<br><strong>Tim Admin</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Nama Aplikasi. Semua hak dilindungi.
    </div>
</div>
</body>
</html>
