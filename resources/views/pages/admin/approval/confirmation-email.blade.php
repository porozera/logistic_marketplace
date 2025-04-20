<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Permintaan Dokumen Legalitas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fd;
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
            background-color: #007bff;
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
            color: #007bff;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888888;
            font-size: 13px;
        }

        .info-box {
            background-color: #eaf3ff;
            padding: 15px;
            border-left: 4px solid #007bff;
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
        <h2>Permintaan Dokumen Legalitas</h2>
    </div>
    <div class="content">
        <p>Halo <strong>{{ $companyName }}</strong>,</p>

        <p>Terima kasih telah melakukan pendaftaran pada sistem kami. Saat ini, kami memerlukan dokumen tambahan untuk keperluan verifikasi.</p>

        <div class="info-box">
            <p>Mohon untuk mengirimkan dokumen bukti legalitas perusahaan berupa <strong>Surat Pernyataan Laporan Penyelenggara POS</strong> untuk kami lakukan pengecekan lebih lanjut.</p>
            
        </div>

        <p>Dokumen dapat dikirimkan melalui sistem atau melalui email ke alamat kami.</p>

        <p>Mohon untuk mengirimkan dokumen tersebut selambat-lambatnya dalam waktu 7 (tujuh) hari kerja sejak email ini dikirimkan.</p>

        <p>Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim kami.</p>

        <p>Terima kasih atas perhatian dan kerja samanya.</p>

        <p>Salam hormat,<br><strong>Tim Admin</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Nama Aplikasi. Semua hak dilindungi.
    </div>
</div>
</body>
</html>
