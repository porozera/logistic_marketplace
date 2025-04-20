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
        <h2>Tanggapan Keluhan Anda</h2>
    </div>
    <div class="content">
        <p>Halo <strong>{{ $username }}</strong>,</p>

        <p>{{ $pesan }}</p>

        <p>Terima kasih telah menghubungi kami. Jika ada yang ditanyakan, silahkan untuk menghubungi kembali.</p>

        <p>Salam hormat,<br><strong>Tim Admin</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Logistic Platform. Semua hak dilindungi.
    </div>
</div>
</body>
</html>
