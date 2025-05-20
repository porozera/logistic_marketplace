<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logistic Marketplace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/waterboat/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('template/waterboat/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/owl.theme.default.min.css') }}">
  
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('template/waterboat/fonts/flaticon/font/flaticon.css') }}">
  
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/jquery.mb.YTPlayer.min.css') }}">
  
    <link rel="stylesheet" href="{{ asset('template/waterboat/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                {{-- logo --}}
                <div class="site-logo">
                    <img src=" {{ asset('images/Logo_SentraLogiX.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
                </div>
                {{-- navbar --}}
                <div class="ml-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                            <li>
                                <a href="landing-page" class="nav-link text-left">Home</a>
                            </li>
                            <li class="">
                                <a href="/landing-page/search-route" class="nav-link text-left">Cari Rute</a>
                            </li>
                            <li class="active">
                                <a href="testimonials.html" class="nav-link text-left">Faq</a>
                            </li>
                            <li>
                                <a href="{{'landing-contact'}}" class="nav-link text-left">Contact</a>
                            </li>
                            <li>
                                <a href="/login" class="nav-link text-left">Masuk</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 750px; padding-top: 100px;">
        <h2 class="text-center text-black mb-4">Help Center</h2>
    
        <!-- Search Bar -->
        <div class="input-group mb-4">
            <input type="text" class="form-control" placeholder="Search help articles...">
            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>
    
        <!-- Kategori dalam 2 Kolom -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <a href="landing-faq/faq-general" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-box-fill text-black" style="font-size: 2rem;"></i>
                                <h3 class="card-title text-black pt-3">General</h3>
                                <p class="card-text text-black">Membantu menjawab pertanyaan umum yang sering diajukan oleh pengguna.</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="landing-faq/faq-peralatan" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-tools text-black" style="font-size: 2rem;"></i>
                                <h3 class="card-title text-black pt-3">Peralatan</h3>
                                <p class="card-text text-black">Masalah umum yang mungkin terjadi pada peralatan yang digunakan dalam layanan atau produk tertentu.</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="landing-faq/faq-harga" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-credit-card-2-back-fill text-black" style="font-size: 2rem;"></i>
                                <h3 class="card-title text-black pt-3">Pembayaran</h3>
                                <p class="card-text text-black">Informasi terkait biaya, metode pembayaran, serta pertanyaan lain terkait dengan transaksi.</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="landing-faq/faq-pengiriman" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <i class="bi bi-truck text-black" style="font-size: 2rem;"></i>
                                <h3 class="card-title text-black pt-3">Pengiriman</h3>
                                <p class="card-text text-black">Informasi mengenai proses serta kendala yang mungkin terjadi selama pengiriman.</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    
    {{-- @foreach ($categories as $category)
        <div class="col-md-6 mb-4">
            <a href="{{ route('faq.show', $category->id) }}" class="text-decoration-none">
                <div class="card shadow-sm p-3">
                    <h5 class="fw-bold">{{ $category->name }}</h5>
                    <p>{{ $category->description }}</p>
                </div>
            </a>
        </div>
    @endforeach --}}

    
    {{-- footer --}}
    <div class="footer bg-light mt-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <p class="mb-4"><img src="{{ asset('images/Logo_SentraLogiX.png') }}" alt="Image" class="img-fluid"></p>
              <p style="text-align: justify; margin-right: 10px;">Platform digital yang menghubungkan pengirim dan penyedia jasa logistik untuk mendapatkan penawaran terbaik dalam pengiriman barang.</p>  
              <p><a href="#">Learn More</a></p>
            </div>
            <div class="col-lg-3">
              <h3 class="footer-heading"><span>Our Company</span></h3>
              <ul class="list-unstyled">
                  <li><a href="#">About</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Our Team</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Projects</a></li>
              </ul>
            </div>
            <div class="col-lg-3">
                <h3 class="footer-heading"><span>Our Services</span></h3>
                <ul class="list-unstyled">
                    <li><a href="#">Industrial</a></li>
                    <li><a href="#">Construction</a></li>
                    <li><a href="#">Remodeling</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h3 class="footer-heading"><span>Contact</span></h3>
                <ul class="list-unstyled">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Support Community</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Our Partners</a></li>
                </ul>
            </div>
          </div>
  
          <div class="row">
            <div class="col-12">
              <div class="copyright">
                  <p>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
              </div>
            </div>
          </div>
        </div>
      </div>


    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

<script src="{{ asset('template/waterboat/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery-ui.js') }}"></script>
<script src="{{ asset('template/waterboat/js/popper.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('template/waterboat/js/aos.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('template/waterboat/js/jquery.mb.YTPlayer.min.js') }}"></script>





<script src="{{ asset('template/waterboat/js/main.js') }}"></script>
    
</body>
</html>