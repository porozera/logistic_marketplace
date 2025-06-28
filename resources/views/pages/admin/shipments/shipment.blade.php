@extends('layouts.app')

@section('title', 'Pemesanan')

@section('content')
  <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Pemesanan</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Laporan Pemesanan</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- HTML5 Export Buttons table start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header table-card-header">
                <h4>Data Akun Pemesanan</h4>
                <p
                  >Halaman ini digunakan untuk melihat detail informasi pemesanan yang terjadi di dalam sistem.</p
                >
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="basic-btn" class="table table-hover nowrap">
                    <thead>
                      <tr>
                        <th>No Offer</th>
                        <th>Pengirim</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>Waktu Pengiriman</th>
                        <th>Waktu Sampai</th>
                        <th>Tipe Pengiriman</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($shipments as $shipment)
                      <tr>
                        <td>{{ $shipment->noOffer }}</td>
                        <td>{{ $shipment->lspName }}</td>
                        <td>{{ $shipment->origin }}</td>
                        <td>{{ $shipment->destination }}</td>
                        <td>
                          @php
                              $badgeClass = match($shipment->status) {
                                  'Loading Item' => 'bg-light-warning',
                                  'On The Way' => 'bg-light-primary',
                                  'Finished' => 'bg-light-success',
                                  default => 'bg-light-secondary'
                              };
                          @endphp
                          <span class="badge {{ $badgeClass }} rounded-pill f-12">
                              {{ $shipment->status }}
                          </span>
                      </td>
                        <td>{{ $shipment->deliveryDate }}</td>
                        <td>{{ $shipment->arrivalDate }}</td>
                        <td>{{ $shipment->shipmentType }}</td>
                      <td class="text-center">
                        @php
                            $badgeClass = match($shipment->paymentStatus) {
                                'Belum Lunas' => 'bg-light-warning',
                                'Gagal' => 'bg-light-danger',
                                'Lunas' => 'bg-light-success',
                                default => 'bg-light-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} rounded-pill f-12">
                            {{ $shipment->paymentStatus }}
                        </span>
                    </td>
                        <td>
                          <ul class="list-inline me-auto mb-0">
                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="View">
                              <a href="{{ route('admin.shipment.show', $shipment->id) }}" class="avtar avtar-xs btn-link-secondary">
                                  <i class="ti ti-eye f-18"></i>
                              </a>
                            </li>
                          </ul>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No Offer</th>
                        <th>Pengirim</th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>Waktu Loading</th>
                        <th>Waktu Pengiriman</th>
                        <th>Tipe Pengiriman</th>
                        <th>Status Pembayaran</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- HTML5 Export Buttons end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
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

 <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
  <div class="offcanvas-header bg-primary">
    <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="pct-body" style="height: calc(100% - 60px)">
    <div class="offcanvas-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-layout-sidebar f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Layout</h6>
                <span>Choose your layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse1">
            <div class="pct-content">
              <div class="pc-rtl">
                <p class="mb-1">Direction</p>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="layoutmodertl">
                  <label class="form-check-label" for="layoutmodertl">RTL</label>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-brush f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Theme Mode</h6>
                <span>Choose light or dark mode</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse2">
            <div class="pct-content">
              <div class="theme-color themepreset-color theme-layout">
                <a href="#!" class="active" onclick="layout_change('light')" data-value="false"
                  ><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Light</span></a
                >
                <a href="#!" class="" onclick="layout_change('dark')" data-value="true"
                  ><span><img src="../assets/images/customization/dark.svg" alt="img"></span><span>Dark</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-color-swatch f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Color Scheme</h6>
                <span>Choose your primary theme color</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse3">
            <div class="pct-content">
              <div class="theme-color preset-color">
                <a href="#!" class="active" data-value="preset-1"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 1</span></a
                >
                <a href="#!" class="" data-value="preset-2"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 2</span></a
                >
                <a href="#!" class="" data-value="preset-3"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 3</span></a
                >
                <a href="#!" class="" data-value="preset-4"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 4</span></a
                >
                <a href="#!" class="" data-value="preset-5"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 5</span></a
                >
                <a href="#!" class="" data-value="preset-6"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 6</span></a
                >
                <a href="#!" class="" data-value="preset-7"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 7</span></a
                >
                <a href="#!" class="" data-value="preset-8"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 8</span></a
                >
                <a href="#!" class="" data-value="preset-9"
                  ><span><img src="../assets/images/customization/theme-color.svg" alt="img"></span><span>Theme 9</span></a
                >
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item pc-boxcontainer">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-border-inner f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Layout Width</h6>
                <span>Choose fluid or container layout</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse4">
            <div class="pct-content">
              <div class="theme-color themepreset-color boxwidthpreset theme-container">
                <a href="#!" class="active" onclick="change_box_container('false')" data-value="false"><span><img src="../assets/images/customization/default.svg" alt="img"></span><span>Fluid</span></a>
                <a href="#!" class="" onclick="change_box_container('true')" data-value="true"><span><img src="../assets/images/customization/container.svg" alt="img"></span><span>Container</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-xs bg-light-primary">
                  <i class="ti ti-typography f-18"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">Font Family</h6>
                <span>Choose your font family.</span>
              </div>
              <i class="ti ti-chevron-down"></i>
            </div>
          </a>
          <div class="collapse show" id="pctcustcollapse5">
            <div class="pct-content">
              <div class="theme-color fontpreset-color">
                <a href="#!" class="active" onclick="font_change('Public-Sans')" data-value="Public-Sans"
                  ><span>Aa</span><span>Public Sans</span></a
                >
                <a href="#!" class="" onclick="font_change('Roboto')" data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                <a href="#!" class="" onclick="font_change('Poppins')" data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                <a href="#!" class="" onclick="font_change('Inter')" data-value="Inter"><span>Aa</span><span>Inter</span></a>
              </div>
            </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="collapse show">
            <div class="pct-content">
              <div class="d-grid">
                <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

    <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/jszip.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/mantis/dist/assets/js/plugins/buttons.bootstrap5.min.js') }}"></script>

    <script>
      // [ HTML5 Export Buttons ]
      $('#basic-btn').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'print']
      });

      // [ Column Selectors ]
      $('#cbtn-selectors').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copyHtml5',
            exportOptions: {
              columns: [0, ':visible']
            }
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: ':visible'
            }
          },
          {
            extend: 'pdfHtml5',
            exportOptions: {
              columns: [0, 1, 2, 5]
            }
          },
          'colvis'
        ]
      });

      // [ Excel - Cell Background ]
      $('#excel-bg').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            customize: function (xlsx) {
              var sheet = xlsx.xl.worksheets['sheet1.xml'];
              $('row c[r^="F"]', sheet).each(function () {
                if ($('is t', this).text().replace(/[^\d]/g, '') * 1 >= 500000) {
                  $(this).attr('s', '20');
                }
              });
            }
          }
        ]
      });

      // [ Custom File (JSON) ]
      $('#pdf-json').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
            text: 'JSON',
            action: function (e, dt, button, config) {
              var data = dt.buttons.exportData();
              $.fn.dataTable.fileSave(new Blob([JSON.stringify(data)]), 'Export.json');
            }
          }
        ]
      });
    </script>
    <!-- [Page Specific JS] end -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




@endsection
