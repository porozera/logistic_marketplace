<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Kebijakan Layanan LSP</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('template/mantis/dist/assets/images/favicon.svg') }}" type="image/x-icon">
  <!-- [Google Font] Family -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <!-- [Tabler Icons] https://tablericons.com -->
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/tabler-icons.min.css') }}">
  <!-- [Feather Icons] https://feathericons.com -->
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/feather.css') }}">
  <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/fontawesome.css') }}">
  <!-- [Material Icons] https://fonts.google.com/icons -->
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/material.css') }}">
  <!-- [Template CSS Files] -->
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/style.css') }}" id="main-style-link">
  <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/style-preset.css') }}">
  <style>
    .auth-main {
        background-image: url('{{ asset("template/waterboat/images/hero-1.jpg") }}');
        background-size: cover;
        background-position: center;
    }

    .text-justify {
    text-align: justify;
  }
  </style>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main">
    <div class="auth-wrapper v3">
      <div class="auth-form">
        <div class="auth-header">
          <a href="/login"><img src="{{ asset('template/mantis/dist/assets/images/logo-dark.svg') }}" alt="img"></a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-primary">Syarat dan Ketentuan Penyedia Jasa Logistik </h4>
                <hr>
                <p class="text-justify">1.
                   Dengan mendaftar sebagai Penyedia Jasa Logistik (LSP) di platform kami, Anda setuju untuk mematuhi dan tunduk pada syarat dan ketentuan yang berlaku. 
                    Anda bertanggung jawab untuk memberikan layanan logistik yang sesuai dengan informasi yang telah Anda cantumkan di platform. 
                    Segala informasi mengenai layanan, harga, serta ketentuan lainnya harus akurat dan jelas bagi pengguna.
                </p>
                <p class="text-justify">
                   2. Anda setuju bahwa platform kami hanya berfungsi sebagai perantara dan tidak bertanggung jawab atas pelaksanaan layanan yang Anda sediakan. Setiap transaksi yang terjadi merupakan perjanjian langsung antara Anda dan pengguna layanan. Anda juga diharapkan mematuhi peraturan perundang-undangan yang berlaku terkait jasa logistik, termasuk namun tidak terbatas pada aspek legalitas operasional, keamanan, dan perlindungan konsumen.
                </p>
                <p class="text-justify">
                   3. Kami berhak untuk menangguhkan atau menghentikan akun Anda apabila ditemukan pelanggaran terhadap syarat dan ketentuan ini, atau jika terdapat keluhan yang valid dari pengguna terkait layanan yang Anda sediakan. Kami tidak bertanggung jawab atas kerugian yang diakibatkan oleh penangguhan atau penghentian tersebut.
                </p>
                <p class="text-justify">
                   4. Dengan mendaftar, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh ketentuan yang ada.
                </p>
                <hr>
                <a href="javascript:history.back()" class="btn btn-primary w-100">Kembali</a>
            </div>
        </div>
        <div class="auth-footer row">
          <!-- <div class=""> -->
            <div class="col my-1">
              <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Contact us</a></li>
              </ul>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->

  <script>
    // Menambahkan event listener untuk radio buttons
    document.querySelectorAll('input[name="btn_radio1"]').forEach((radio) => {
      radio.addEventListener('change', function() {
        if (this.checked && this.dataset.url) {
          window.location.href = this.dataset.url;
        }
      });
    });
  </script>
  <script src="{{ asset('template/mantis/dist/assets/js/plugins/popper.min.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/plugins/simplebar.min.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/fonts/custom-font.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/pcoded.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/plugins/feather.min.js') }}"></script>
  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  

</html>