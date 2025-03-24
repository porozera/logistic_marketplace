<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Registrasi LSP</title>
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
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h4 class="mb-0"><b>Buat Akun LSP</b></h4>
              <a href="/login" class="link-primary">Sudah punya akun?</a>
            </div>
            <div class="row">
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" id="btnrdo1" name="btn_radio1" data-url="/register-customer"> 
                <label class="btn btn-outline-primary" for="btnrdo1">Customer</label>
            
                <input type="radio" class="btn-check" id="btnrdo3" name="btn_radio1" checked> 
                <label class="btn btn-outline-primary" for="btnrdo3">LSP</label>
              </div>
            </div>
            <br>
            <form action="/register-lsp" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="companyName" class="form-control" placeholder="Nama Perusahaan" value="{{ old('companyName') }}">
                    @error('username') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                </div>
                <div class="form-group mb-3">
                  <label class="form-label">Nomor Izin Penyelenggara</label>
                  <input type="text" name="permitNumber" class="form-control" placeholder="Nomor Izin Penyelenggara" value="{{ old('permitNumber') }}">
                  @error('permitNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
              </div>
                <div class="form-group mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="telpNumber" class="form-control" placeholder="Nomor Telepon" value="{{ old('telpNumber') }}">
                    @error('telpNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="address" rows="3" placeholder="Alamat">{{ old('address') }}</textarea>
                    @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                </div>
                <div class="form-group mb-3">
                    <input type="hidden" name="role" class="form-control" placeholder="role" value="customer">
                </div>
                  <input class="form-check-input" type="checkbox" name="terms" id="terms">
                  <label class="form-check-label" for="terms">
                    <span class="mt-4 text-sm text-muted ms-2">Dengan Mendaftar, Anda menyetujui <a href="/terms-of-service/lsp" class="text-primary"> Kebijakan Layanan </a> kami.</span>
                  </label>
                  @error('terms') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                  <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Buat Akun</button>
                  </div>   
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
            </form>       
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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