<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Login</title>
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
          <a href="/landing-page"><img src="{{ asset('template/mantis/dist/assets/images/logo-dark.svg') }}" alt="img"></a>
        </div>
        <div class="card my-5">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end mb-4">
              <h3 class="mb-0"><b>Login</b></h3>
              <a href="/register-customer" class="link-primary">Tidak punya akun?</a>
            </div>
            
         <form action="/login" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" autofocus required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="ti ti-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                    <span class="input-group-text">
                      <i class="ti ti-eye-off" id="togglePassword" 
                     style="cursor: pointer"></i>
                     </span>
                </div>
                @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
              </div>
              <div class="d-flex mt-1 justify-content-between">
                <div class="form-check">
                  <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="">
                  <label class="form-check-label text-muted" for="customCheckc1">Tetap Sign In</label>
                </div>
                <h5 class="text-secondary f-w-400">Lupa Password?</h5>
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
            @endif

          </div>
        </div>
        <div class="auth-footer row">
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
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
    
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle('ti-eye-off');
    this.classList.toggle('ti-eye');
    });
  </script>
  <!-- Required Js -->
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

</body>
<!-- [Body] end -->

</html>