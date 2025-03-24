<!DOCTYPE html>
<html lang="en">

<head>
    <title>Collapse | Mantis Bootstrap 5 Admin Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">
    <!-- [Favicon] -->
    <link rel="icon" href="{{ asset('template/mantis/dist/assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Page Specific CSS] -->
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/plugins/animate.min.css') }}" type="text/css">
    <!-- [Google Fonts] -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <!-- [Icons & Fonts] -->
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/style-preset.css') }}">
    <link rel="stylesheet" href="{{ asset('template/mantis/dist/assets/css/uikit.css') }}">

</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light" class="component-page">
  <!-- [ Main Content ] start -->
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <!-- [ Nav ] start -->
  {{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark default">
    <div class="container">
      <a class="navbar-brand" href="../index.html">
        <img src="../assets/images/logo-white.svg" alt="logo">
      </a>
      <button
        class="navbar-toggler rounded"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
          <li class="nav-item px-1">
            <a class="nav-link" href="https://codedthemes.gitbook.io/mantis-bootstrap/" target="_blank">Documentation</a>
          </li>
          <li class="nav-item px-1">
            <a class="nav-link" href="../dashboard/index.html">Live Preview</a>
          </li>
          <li class="nav-item px-1 me-2 mb-2 mb-md-0">
            <a
              class="btn btn-icon btn-secondary"
              target="_blank"
              href="https://github.com/codedthemes/mantis-free-bootstrap-admin-template/tree/master"
              ><i class="ti ti-brand-github"></i
            ></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary" href="#">Purchase Now</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> --}}
 
  

  <section class="component-block card-border-outside">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-xl-8">
          <!-- [ breadcrumb ] start -->
          <div class="page-header">
            <div class="page-block">
              <div class="row align-items-center">
                <div class="col-md-12">
                  <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../dashboard/index.html">FAQs</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0)">FAQs Peralatan</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- [ breadcrumb ] end -->
          <div class="row">
            <div class="mb-4">
              <h1>FAQs Peralatan</h1>
              <p class="text-muted">FAQ Peralatan berisi kumpulan pertanyaan yang sering diajukan terkait dengan penggunaan, pemeliharaan, spesifikasi, serta masalah umum yang mungkin terjadi pada peralatan yang digunakan dalam layanan atau produk tertentu.</p>
            </div>
            <!-- [ Search Form ] start -->
            <div class="d-flex justify-content-center mb-4">
                <div class="input-group">
                <input type="text" class="form-control shadow-sm" id="searchInput" placeholder="Search FAQs..." aria-label="Search">
                <button class="btn btn-primary shadow-sm" type="button" onclick="searchAccordion()">
                    <i class="ti ti-search"></i>
                </button>
                </div>
            </div>
            <!-- [ Search Form ] end -->
          </div>
          <!-- [ Main Content ] start -->
          <div class="row">
            <!-- [ accordion-collapse ] start -->
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body pc-component">
                  <div class="accordion card" id="accordionExample">
                    
                    <div class="accordion" id="accordionExample">
                      @foreach ($faqs as $index => $item)
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}"> <h5><strong>
                              {{ $item->header }}
                            </h5></strong>
                            </button>
                          </h2>
                          <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              {{ $item->description }}
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- [ accordion-collapse ] end -->
          </div>
          <!-- [ Main Content ] end -->
        </div>
      </div>
    </div>
  </section>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <!-- [JavaScript Plugins] -->
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

    <script>
        function searchAccordion() {
          let input = document.getElementById("searchInput").value.toLowerCase();
          let accordionItems = document.querySelectorAll(".accordion-item");
          
          accordionItems.forEach(item => {
            let text = item.innerText.toLowerCase();
            if (text.includes(input)) {
              item.style.display = "block";
            } else {
              item.style.display = "none";
            }
          });
        }
      </script>
      <script>
        function searchAccordion() {
            var input, filter, items, header, description, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            items = document.getElementsByClassName("accordion-item");
    
            for (i = 0; i < items.length; i++) {
                header = items[i].getElementsByClassName("accordion-button")[0]; 
                description = items[i].getElementsByClassName("accordion-body")[0];
    
                if (header || description) {
                    txtValue = (header.textContent || header.innerText) + " " + (description.textContent || description.innerText);
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        items[i].style.display = ""; // Tampilkan jika cocok
                    } else {
                        items[i].style.display = "none"; // Sembunyikan jika tidak cocok
                    }
                }
            }
        }
    
        // Event listener untuk mendeteksi input ketika user mengetik
        document.getElementById("searchInput").addEventListener("keyup", function () {
            searchAccordion();
        });
    </script>

</body>
</html>