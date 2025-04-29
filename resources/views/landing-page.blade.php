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
                                <li class="active">
                                    <a href="#" class="nav-link text-left">Home</a>
                                </li>
                                <li>
                                    <a href="/landing-page/search-route" class="nav-link text-left">Cari Rute</a>
                                </li>
                                <li>
                                    <a href="{{'landing-faq'}}" class="nav-link text-left">Faq</a>
                                </li>
                                <li>
                                    <a href="{{'landing-contact'}}" class="nav-link text-left">Contact</a>
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
    
    <div class="hero-slide owl-carousel site-blocks-cover">
        <div class="intro-section" style="background-image: url('{{ asset('template/waterboat/images/hero-1.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mr-auto text-left" data-aos="fade-up">
                        <h1>Optimalkan Pengiriman Anda dengan <span class="text-warning">Platform Kami</span></h1>
                        <p>Kami hadir untuk membantu bisnis dan individu dalam mengoptimalkan pengiriman barang menggunakan sistem berbagi kontainer dengan biaya lebih hemat dan proses lebih cepat.</p>
                        <p>
                            <a href="/landing-page/search-route" class="btn btn-primary py-3 px-5">Cari Rute Sekarang!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="intro-section" style="background-image: url('{{ asset('template/waterboat/images/hero-2.jpg') }}');">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
                        <h1>Jangkauan Luas, Pengiriman Cepat, dan Layanan Terpercaya</h1>
                        <p>Dengan jaringan logistik yang luas di seluruh Indonesia, kami memastikan barang Anda sampai dengan aman dan tepat waktu. Baik untuk bisnis maupun individu, solusi logistik kami siap membantu setiap kebutuhan pengiriman Anda dengan efisiensi terbaik.  </p>
                        <p>
                            <a href="#" class="btn btn-primary py-3 px-5">Lihat Layanan Kami</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END slider -->

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('template/waterboat/images/stuffing.jpg') }}" alt="Image" class="img-fluid rounded-2">
                </div>
                <div class="col-md-6">
                  <span class="text-serif text-primary">Tentang Kami</span>
                  <h3 class="heading-92913 text-black">Mengapa Memilih Kami?</h3>
                  <p style="text-align: justify;">
                    📦 <span style="font-weight: bold">Efisiensi Biaya</span> : Kurangi biaya pengiriman dengan sistem berbagi kontainer.<br>
                    ⏳ <span style="font-weight: bold">Pengiriman Lebih Cepat</span> : Optimalkan rute dan kurangi waktu tunggu.<br>
                    🔄 <span style="font-weight: bold">Sistem Penjadwalan Fleksibel</span> : Atur waktu pengiriman sesuai kebutuhan dan optimalkan kapasitas kendaraan.
                  </p>
                  <p class="mt-3"><a href="#" class="btn btn-primary py-3 px-4">Pelajari Lebih Lanjut</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="margin-bottom: 100px;">
        <div class="container">
            <!-- Judul -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="font-weight-bold text-black">Layanan Kami</h2>
                </div>
            </div>
    
            <!-- Grid Keunggulan -->
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283 text-center">
                        <span class="wrap-icon-39293 d-block mb-3">
                            <span class="flaticon-yacht"></span>
                        </span>
                        <h3>Shipping & Logistics</h3>
                        <p>Solusi pengiriman dan logistik yang efisien untuk memastikan barang Anda tiba dengan cepat, aman, dan tepat waktu ke tujuan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283 text-center">
                        <span class="wrap-icon-39293 d-block mb-3">
                            <span class="flaticon-shield"></span>
                        </span>
                        <h3>Book & Track Online</h3>
                        <p>Pesan layanan pengiriman dengan mudah dan lacak status pengiriman Anda secara real-time melalui platform online kami.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-29283 text-center">
                        <span class="wrap-icon-39293 d-block mb-3">
                            <span class="flaticon-captain"></span>
                        </span>
                        <h3>Freight Marketplace</h3>
                        <p>Platform digital yang menghubungkan pengirim dan penyedia jasa logistik untuk mendapatkan penawaran terbaik dalam pengiriman barang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    {{-- Our Client --}}
    <div class="site-section bg-image overlay" style="background-image: url('{{ asset('template/waterboat/images/hero-1.jpg') }}');">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="counter-39392">
              <h3>349</h3>
              <span>Logistic Service Provider</span>
            </div>
          </div>
          <div class="col">
            <div class="counter-39392">
              <h3>1000</h3>
              <span>Customers Satisfied</span>
            </div>
          </div>
          {{-- <div class="col">
            <div class="counter-39392">
              <h3>120</h3>
              <span>Number of Staffs</span>
            </div>
          </div> --}}
          <div class="col">
            <div class="counter-39392">
              <h3>493</h3>
              <span>Destinations</span>
            </div>
          </div>
          <div class="col">
            <div class="counter-39392">
              <h3>2530</h3>
              <span>Total Shipment</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <span class="text-serif text-primary">Destination</span>
            <h3 class="heading-92913 text-black text-center">Our Destinations</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_2.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_2.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381">
              <img src="{{ asset('template/waterboat/images/hero_2.jpg') }}" alt="Image" class="img-fluid">
              <div class="p-4">
                <h3><a href="#"><span class="icon-room mr-1 text-primary"></span> Croatia &mdash; Columbia</a></h3>
                <div class="d-flex">
                  <div class="mr-auto">
                    <span class="icon-date_range"></span>
                    Sep. 05 &mdash; Oct. 15
                  </div>
                  <div class="ml-auto price">
                    <span class="bg-primary">$600</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div> --}}

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-2">
          <div class="col-md-7 text-center">
            <span class="text-serif text-primary">Shipment</span>
            <h3 class="heading-92913 text-black text-center">Special Offers</h3>
          </div>
        </div>
        <div class="row">
          @foreach ($offers as $offer)
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="service-39381" style="border-radius: 8px;">
              <div class="p-4">
                <div class="ml-auto text-right">
                  <h3 class="d-inline-block text-black" style="text-align: right; background-color: #f5f4f4; padding: 8px; border-radius: 8px;"><i class="bi bi-box"></i>  {{$offer->shipmentType}}</h3>
                </div>
                <h3><a href="/search-routes/{{$offer['id']}}"><span><p>Departure: </p></span> <p class="text-primary">{{$offer->origin}}</p></a></h3>
                <h3><a href="/search-routes/{{$offer['id']}}"><span><p>Arival: </p></span> <p class="text-primary">{{$offer->destination}}</p></a></h3>
                <div class="">
                  <div class="mr-auto pb-3">
                    <span class="icon-date_range"></span>
                    {{$offer->shipping_date_formatted}}
                  </div>
                  <div class="ml-auto price d-flex text-black">
                    <h3 class="mx-2" style="font-size: 30px;">Rp. {{ number_format($offer['price'], 0, ',', '.')}}</h3>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
      <div class="row justify-content-center">
        <div class="col-md-7 text-center">
          <p class="mb-0 pt-3"><a href="/landing-page/search-route" class="btn btn-primary py-3 px-5 text-white">Cari Pengiriman</a></p>
        </div>
      </div>
    </div>

    {{-- <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <p><img src="{{ asset('template/waterboat/images/hero_1.jpg') }}" alt="Image" class="img-fluid"></p>
          </div>
          <div class="col-md-5">
            <span class="text-serif text-primary">Book Now</span>
            <h3 class="heading-92913 text-black">Book A Yacht</h3>
            <form action="#" class="row">
              <div class="form-group col-md-6">
                <label for="input-1">Full Name:</label>
                <input type="text" class="form-control" id="input-1">
              </div>
              <div class="form-group col-md-6">
                <label for="input-2">Number of People:</label>
                <input type="text" class="form-control" id="input-2">
              </div>

              <div class="form-group col-md-6">
                <label for="input-3">Date From:</label>
                <input type="text" class="form-control datepicker" id="input-3">
              </div>
              <div class="form-group col-md-6">
                <label for="input-4">Date To:</label>
                <input type="text" class="form-control datepicker" id="input-4">
              </div>

              <div class="form-group col-md-12">
                <label for="input-5">Yacht You're Interested in:</label>
                <select name="" id="input-5" class="form-control">
                  <option value="">Motor Yacht</option>
                  <option value="">Hi-Speed Yacht</option>
                  <option value="">Premium Yacht</option>
                  <option value="">Presidential Yacht</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="input-6">Email Address</label>
                <input type="text" class="form-control" id="input-6">
              </div>

              <div class="form-group col-md-6">
                <label for="input-7">Phone Number</label>
                <input type="text" class="form-control" id="input-7">
              </div>


              
              <div class="form-group col-md-12">
                <label for="input-8">Notes</label>
                <textarea name="" id="input-8" cols="30" rows="5" class="form-control"></textarea>
              </div>

              <div class="form-group col-md-12">
                <input type="submit" class="btn btn-primary py-3 px-5" value="Book Now">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
     --}}

    {{-- <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <span class="text-serif text-primary">Team</span>
            <h3 class="heading-92913 text-black text-center">Our Team</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-lg-0">
            <div class="person">
              <figure>
                <img src="{{ asset('template/waterboat/images/person_1.jpg') }}" alt="Image" class="img-fluid">
                <div class="social">
                  <a href="#"><span class="icon-facebook"></span></a>
                  <a href="#"><span class="icon-twitter"></span></a>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </div>
              </figure>
              <div class="person-contents">
                <h3>Craig Daniel</h3>
                <span class="position">Engineer</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mb-lg-0">
            <div class="person">
              <figure>
                <img src="{{ asset('template/waterboat/images/person_2.jpg') }}" alt="Image" class="img-fluid">
                <div class="social">
                  <a href="#"><span class="icon-facebook"></span></a>
                  <a href="#"><span class="icon-twitter"></span></a>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </div>
              </figure>
              <div class="person-contents">
                <h3>Craig Daniel</h3>
                <span class="position">Engineer</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mb-lg-0">
            <div class="person">
              <figure>
                <img src="{{ asset('template/waterboat/images/person_3.jpg') }}" alt="Image" class="img-fluid">
                <div class="social">
                  <a href="#"><span class="icon-facebook"></span></a>
                  <a href="#"><span class="icon-twitter"></span></a>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </div>
              </figure>
              <div class="person-contents">
                <h3>Craig Daniel</h3>
                <span class="position">Engineer</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mb-lg-0">
            <div class="person">
              <figure>
                <img src="{{ asset('template/waterboat/images/person_4.jpg') }}" alt="Image" class="img-fluid">
                <div class="social">
                  <a href="#"><span class="icon-facebook"></span></a>
                  <a href="#"><span class="icon-twitter"></span></a>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </div>
              </figure>
              <div class="person-contents">
                <h3>Craig Daniel</h3>
                <span class="position">Engineer</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div> --}}

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <span class="text-serif text-primary">Testimonial</span>
            <h3 class="heading-92913 text-black text-center">What Customer Saying...</h3>
          </div>
        </div>
        <div class="row">
          <div class="mb-4 mb-lg-0 col-md-6 col-lg-4">
            <div class="testimony-39291">
              <blockquote>
                <p>Saya sangat terbantu dengan platform ini! Proses pengiriman barang jadi lebih cepat dan efisien. Tarifnya transparan dan saya bisa memilih layanan yang sesuai kebutuhan. Sangat direkomendasikan.</p>
              </blockquote>
              <div class="d-flex vcard align-items-center">
                <div class="pic mr-3">
                  <img src="{{ asset('template/waterboat/images/person_3_sq.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="text">
                  <strong class="d-block">Rudi Santoso</strong>
                  <span>Customer</span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4 mb-lg-0 col-md-6 col-lg-4">
            <div class="testimony-39291">
              <blockquote>
                <p>Sebelumnya, saya sering kesulitan mencari jasa logistik yang terpercaya. Dengan Logistic Marketplace, saya bisa langsung membandingkan harga dan jadwal pengiriman dengan mudah. Pelayanannya juga responsif!</p>
              </blockquote>
              <div class="d-flex vcard align-items-center">
                <div class="pic mr-3">
                  <img src="{{ asset('template/waterboat/images/person_4_sq.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="text">
                  <strong class="d-block">Bambang Supratman</strong>
                  <span>Customer</span>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4 mb-lg-0 col-md-6 col-lg-4">
            <div class="testimony-39291">
              <blockquote>
                <p>Fitur tracking real-time sangat membantu saya dalam memantau pengiriman barang. Satu-satunya yang bisa ditingkatkan adalah lebih banyak pilihan ekspedisi agar semakin fleksibel. Tapi sejauh ini, sangat puas.</p>
              </blockquote>
              <div class="d-flex vcard align-items-center">
                <div class="pic mr-3">
                  <img src="{{ asset('template/waterboat/images/person_3_sq.jpg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="text">
                  <strong class="d-block">Budi Prasetyo</strong>
                  <span>Customer</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('{{ asset('template/waterboat/images/hero-2.jpg') }}');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="text-white">Dapatkan info dan berita terbaru dari kami</h2>
            <p class="lead text-white">Tetap terhubung dengan kami untuk mendapatkan update terbaru, penawaran spesial, dan berita menarik lainnya!</p>
            <p class="mb-0"><a href="#" class="btn btn-warning py-3 px-5 text-white">Contact Us</a></p>
          </div>
        </div>
      </div>
    </div>

    
    <div class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <p class="mb-4"><img src="{{ asset('template/waterboat/images/logo.png') }}" alt="Image" class="img-fluid"></p>
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