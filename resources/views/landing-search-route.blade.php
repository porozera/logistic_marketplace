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
  

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        
        <div class="header-top bg-light">
            {{-- <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-3">
                        <a href="index.html">
                            <img src="{{ asset('template-waterboat/images/logo.png') }}" alt="Image" class="img-fluid">
                            <!-- <strong>Water</strong>Boat -->
                        </a>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="quick-contact-icons d-flex">
                            <div class="icon align-self-start">
                                <span class="icon-location-arrow text-primary"></span>
                            </div>
                            <div class="text">
                                <span class="h4 d-block">San Francisco</span>
                                <span class="caption-text">Mountain View, Fake st., CA</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="quick-contact-icons d-flex">
                            <div class="icon align-self-start">
                                <span class="icon-phone text-primary"></span>
                            </div>
                            <div class="text">
                                <span class="h4 d-block">000 209 392 312</span>
                                <span class="caption-text">Toll free</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="quick-contact-icons d-flex">
                            <div class="icon align-self-start">
                                <span class="icon-envelope text-primary"></span>
                            </div>
                            <div class="text">
                                <span class="h4 d-block">info@gmail.com</span>
                                <span class="caption-text">Gournadi, 1230 Bariasl</span>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-6 d-block d-lg-none text-right">
                        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                            class="icon-menu h3"></span></a>
                    </div>
            </div>
        </div>
      

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
                                    <a href="/" class="nav-link text-left">Home</a>
                                </li>
                                <li class="active">
                                    <a href="/landing-page/search-route" class="nav-link text-left">Cari Rute</a>
                                </li>
                                <li>
                                    <a href="/landing-faq" class="nav-link text-left">Faq</a>
                                </li>
                                <li>
                                    <a href="/landing-contact" class="nav-link text-left">Contact</a>
                                </li>
                                <li>
                                  @guest
                                      <a href="{{ route('login') }}" class="nav-link text-left">Masuk</a>
                                  @else
                                      @php
                                          $role = Auth::user()->role;
                                          $dashboardRoutes = [
                                              'admin' => route('admin.dashboard'),
                                              'lsp' => route('lsp-dashboard'),
                                              'customer' => route('dashboard-customer'),
                                          ];
                                          $dashboardUrl = $dashboardRoutes[$role] ?? route('home');
                                      @endphp
                                      <a href="{{ $dashboardUrl }}" class="nav-link text-left">Dashboard</a>
                                  @endguest
                              </li>
                              {{-- <li>
                                <a href="#" class="pc-link bg-transparent" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <span class="pc-micon"><i class="ti ti-power text-danger"></i></span>
                                  <span class="pc-mtext text-danger">Logout</span>
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                              </li> --}}
                              
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-2">
          <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('landing-page.search-route') }}">
                        <div class="row mb-0 mt-0">
                            <div class="col-sm-12 col-md-3">
                                <input type="text" name="origin" class="form-control" placeholder="Kota Asal" value="{{ request('origin') }}">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" name="destination" class="form-control" placeholder="Kota Tujuan" value="{{ request('destination') }}">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <input type="date" name="shippingDate" class="form-control" placeholder="Tanggal Pengiriman" value="{{ request('shippingDate') }}">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <select class="form-control" name="shipmentType" id="shipmentType">
                                    <option value="FCL" {{ request('shipmentType') == 'FCL' ? 'selected' : '' }}>Full Container Load</option>
                                    <option value="LCL" {{ request('shipmentType') == 'LCL' ? 'selected' : '' }}>Less Container Load</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-1">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
        <div class="row">
        @if(!$searchPerformed)
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="card text-center p-4">
                <div class="card-body">
                    <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                    <h3 class="mb-2">Cari untuk memulai!</h3>
                    <p class="text-muted">Masukkan kota asal dan tujuan untuk memulai pencarian.</p>
                </div>
            </div> 
        </div>
        @elseif ($offers->isEmpty())
        <div class="col-md-12 col-lg-12 mb-4">

            <div class="card text-center p-4">
                <div class="card-body">
                    <img src="{{ asset('template/mantis/dist/assets/images/unavailable_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                    <h3 class="mb-2">Rute tidak tersedia</h3>
                    <p class="text-muted">Buat permintaan rute pengiriman baru</p>
                    <a href="/request-routes" class="btn btn-primary w-50">Buat Permintaan</a>
                </div>
            </div> 
        </div>
        @else
          @foreach ($offers as $item)
          <div class="col-md-12 col-lg-12 mb-4">
            <div class="card" style="border-radius: 8px;">
              <div class="card-body">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <a href="/profile/lsp/{{ $item->user->id }}" class="me-4">
                            <img src="{{ $item->user->profilePicture ? asset('storage/' . $item->user->profilePicture) : asset('default-profile.jpg') }}" 
                                alt="profile-lsp" 
                                class="user-avtar border wid-35 rounded-circle" 
                                style="object-fit: cover; width: 35px; height: 35px;">
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="mb-0 fw-bold">{{ $item->user->companyName }}</h5>
                            <i class="fas fa-star text-warning ms-2"></i>
                        </div>
                    </div>
                    <div class="col-4 d-none d-md-flex justify-content-center gap-2 mt-2 mt-md-0">
                        @if ($item['shipmentMode'] == 'D2D')
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-truck-delivery me-1"></i> Door To Door
                            </button>   
                        @elseif( $item['shipmentMode'] == 'D2P')
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-truck-delivery me-1"></i> Door To Port
                            </button>
                        @elseif( $item['shipmentMode'] == 'P2P')
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-sailboat me-1"></i> Port To Port
                            </button>
                        @elseif( $item['shipmentMode'] == 'P2D')
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-truck-delivery me-1"></i> Port To Door
                            </button>
                        @endif
                        @if ($item['shipmentType'] == 'LCL')
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i> LCL
                            </button> 
                        @else
                            <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                                <i class="ti ti-box me-1"></i> FCL
                            </button> 
                        @endif
                        {{-- <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                            <i class="ti ti-box me-1"></i> 20' Container
                        </button>  --}}
                        {{-- <button type="button" class="btn btn-outline-primary d-flex align-items-center rounded-pill">
                            <i class="ti ti-box me-1"></i> General Cargo
                        </button>  --}}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-1 d-flex align-items-start justify-content-start">
                        <p style="font-weight: normal;">Asal</p>
                    </div>
                    <div class="col-1">
                        <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                        <div class="bg-primary mx-auto" style="width: 1px; height: 70px;"></div>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold text-primary">{{$item->origin}}</p>
                    </div>
                    <div class="col-2">
                        <p style="font-weight: normal;">Tanggal Pengiriman</p>
                    </div>
                    <div class="col-3">
                        <p class="text-primary fw-bold">{{$item->shipping_date_formatted}}</p>
                    </div>
                    <div class="col-3 d-flex align-items-start justify-content-end ">
                        @if ($item['shipmentType'] == 'FCL')
                        <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price']*$item['maxVolume'], 0, ',', '.')}}</h4>
                        <p class="mb-0 ms-2 mt-1">/Container</p>
                        @else
                        <h4 class="text-danger fw-bold mb-0">Rp. {{ number_format($item['price'], 0, ',', '.')}}</h4>
                        <p class="mb-0 ms-2 mt-1">/CBM</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 d-flex align-items-start justify-content-start">
                        <p style="font-weight: normal;">Tujuan</p>
                    </div>
                    <div class="col-1">
                        <div class="rounded-circle bg-primary mx-auto" style="width: 8px; height: 8px;"></div>
                    </div>
                    <div class="col-2">
                        <p class="fw-bold text-primary">{{$item->destination}}</p>
                    </div>
                    <div class="col-2">
                        <p class="mb-0" style="font-weight: normal;">Estimasi Tiba</p>
                    </div>
                    <div class="col-3">
                        <p class="text-primary fw-bold">{{$item->estimation_date_formatted}}</p>
                    </div>
                    <div class="col-3 d-flex align-items-start justify-content-end">
                        <a href="/search-routes/{{$item['id']}}" class="btn btn-primary w-50 w-md-50">Lihat detail<i class="ti ti-chevron-right ms-1"></i></a>
                    </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
    <div class="footer bg-light">
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
  </div>
  <!-- .site-wrap -->


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