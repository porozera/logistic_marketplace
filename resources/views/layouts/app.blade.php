<html lang="en">
<head>
    <title>@yield('title', 'Home | Mantis Bootstrap 5 Admin Template')</title>

    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('meta_description', 'Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template')">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('template/mantis/dist/assets/images/favicon.svg') }}" type="image/x-icon">

    {{-- datatables --}}
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/plugins/buttons.bootstrap5.min.css') }}">


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
</head>
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    @include('../layouts.navbars.sidenav')
    @include('../layouts.navbars.topnav')
    @yield('content')
    {{-- @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
        @include('../layouts.navbars.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
        @endif
    @endauth --}}
    @include('../layouts.footers.footer')

    <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- [Page Specific JS] start -->
  <script src="{{ asset('template/mantis/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/mantis/dist/assets/js/pages/dashboard-default.js') }}"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
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
</body>
</html>
