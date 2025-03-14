<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logistic Marketplace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
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
                    <img src=" {{ asset('template/waterboat/images/logo.png') }}" alt="Logo" class="img-fluid" style="height: 50px;">
                </div>
                {{-- navbar --}}
                <div class="ml-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
                            <li>
                                <a href="landing-page" class="nav-link text-left">Home</a>
                            </li>
                            <li>
                                <a href="about.html" class="nav-link text-left">Price Calculator</a>
                            </li>
                            <li>
                                <a href="services.html" class="nav-link text-left">Services</a>
                            </li>
                            <li class="active">
                                <a href="testimonials.html" class="nav-link text-left">Faq</a>
                            </li>
                            <li>
                                <a href="blog.html" class="nav-link text-left">Contact</a>
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
        <h2 class="text-center mb-4">Help Center</h2>
    
        <!-- Search Bar -->
        <div class="input-group mb-4">
            <input type="text" class="form-control" placeholder="Search help articles...">
            <button class="btn btn-primary">
                <i class="ti ti-search"></i>
            </button>
        </div>
    
        <!-- Kategori dalam 2 Kolom -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <a href="landing-faq/faq-general" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">General</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.</p>
                                <a href="#!" class="card-link">Card link</a>
                                <a href="#!" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Peralatan</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.</p>
                                <a href="#!" class="card-link">Card link</a>
                                <a href="#!" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Harga & Pembayaran</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.</p>
                                <a href="#!" class="card-link">Card link</a>
                                <a href="#!" class="card-link">Another link</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a href="#" class="text-decoration-none">
                    <div class="pc-component">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pengiriman</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's
                                content.</p>
                                <a href="#!" class="card-link">Card link</a>
                                <a href="#!" class="card-link">Another link</a>
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
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
          <div class="row">
            <div class="col-sm my-1">
              <p class="m-0"
                >Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes" target="_blank">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.</p
              >
            </div>
            <div class="col-auto my-1">
              <ul class="list-inline footer-link mb-0">
                <li class="list-inline-item"><a href="../index.html">Home</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>


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