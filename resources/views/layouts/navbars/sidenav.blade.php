<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('template/mantis/dist/assets/images/logo-dark.svg') }}" class="img-fluid logo-lg"
                    alt="logo">
            </a>
        </div>
        <div class="navbar-content">

            <ul class="pc-navbar">
                @if (Auth::user()->role === 'admin')
                    <li class="pc-item">
                        <a href="{{ route('admin.dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item {{ Request::is('admin/notifications*') ? 'active' : '' }}">
                        <a href="{{ route('admin.notifications') }}" class="pc-link">
                            <span class="pc-micon position-relative">
                                <i class="ti ti-notification"></i>
                                @php
                                    $unreadNotifications = \App\Models\Notification::where('receiver_id', Auth::id())
                                        ->where('is_read', 0)
                                        ->count();
                                @endphp
                                @if ($unreadNotifications > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger">
                                        {{ $unreadNotifications }}
                                        <span class="visually-hidden">unread notifications</span>
                                    </span>
                                @endif
                            </span>
                            <span class="pc-mtext">Notifikasi</span>
                        </a>
                    </li>

                    <li class="pc-item {{ Request::is('admin/approval-lsp*') ? 'active' : '' }}">
                        <a href="{{ route('admin.approval-lsp') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-checkbox"></i></span>
                            <span class="pc-mtext">Approval LSP</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Master Data</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item {{ Request::is('admin/container*') ? 'active' : '' }}">
                        <a href="{{ route('admin.container') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-caravan"></i></span>
                            <span class="pc-mtext">Kontainer</span>
                        </a>
                    </li>
                    <li class="pc-item {{ Request::is('admin/service*') ? 'active' : '' }}">
                        <a href="{{ route('admin.service') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                            <span class="pc-mtext">Layanan</span>
                        </a>
                    </li>
                    <li class="pc-item {{ Request::is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-box"></i></span>
                            <span class="pc-mtext">Kategori Barang</span>
                        </a>
                    </li>
                    {{-- <li class="pc-item {{ Request::is('admin/province*') ? 'active' : '' }}">
            <a href="province" class="pc-link">
              <span class="pc-micon"><i class="ti ti-building-skyscraper"></i></span>
              <span class="pc-mtext">Provinsi</span>
            </a>
          </li>
          <li class="pc-item {{ Request::is('admin/city*') ? 'active' : '' }}">
            <a href="city" class="pc-link">
              <span class="pc-micon"><i class="ti ti-building"></i></span>
              <span class="pc-mtext">Kota</span>
            </a>
          </li> --}}

                    <li class="pc-item pc-caption">
                        <label>Manajemen Data</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item {{ Request::is('admin/report-customer*') ? 'active' : '' }}">
                        <a href="{{ route('admin.customer.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-users"></i></span>
                            <span class="pc-mtext">Customer</span>
                        </a>
                    </li>
                    <li class="pc-item {{ Request::is('admin/report-lsp*') ? 'active' : '' }}">
                        <a href="{{ route('admin.lsp.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-building-warehouse"></i></span>
                            <span class="pc-mtext">Logistic Service Provider (LSP)</span>
                        </a>
                    </li>
                    <li class="pc-item {{ Request::is('admin/report-shipment*') ? 'active' : '' }}">
                        <a href="{{ route('admin.shipment.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-truck-delivery"></i></span>
                            <span class="pc-mtext">Pemesanan</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Lainnya</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item {{ Request::is('admin/complain*') ? 'active' : '' }}">
                        <a href="{{ route('admin.complain.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-symlink"></i></span>
                            <span class="pc-mtext">Manajemen Komplain</span>
                        </a>
                    </li>
                    <li class="pc-item {{ Request::is('admin/faq*') ? 'active' : '' }}">
                        <a href="{{ route('admin.faq') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-zoom-question"></i></span>
                            <span class="pc-mtext">FAQs Data</span>
                        </a>
                    </li>
                    
                    <li class="pc-item">
                        <a href="#" class="pc-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="pc-micon"><i class="ti ti-logout text-danger"></i></span>
                            <span class="pc-mtext text-danger">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif

                @if (Auth::user()->role === 'lsp')
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/profiles" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Profile</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Request</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="/permintaan-pengiriman" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-tir"></i></span>
                            <span class="pc-mtext">Permintaan Pengiriman</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/opencontainer" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-forklift"></i></span>
                            <span class="pc-mtext">Open Container</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Management</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="/order-management" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-file-text"></i></span>
                            <span class="pc-mtext">Order Management</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/bids-list" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-list-check"></i></span>
                            <span class="pc-mtext">Bid List</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/offers" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-map"></i></span>
                            <span class="pc-mtext">Kelola Rute</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/trucks" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-truck"></i></span>
                            <span class="pc-mtext">Kelola Truck</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="/trackings" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-truck-delivery"></i></span>
                            <span class="pc-mtext">Tracking Order</span>
                        </a>
                    </li>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('opencontainer.list-payment') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-cash"></i></span>
                            <span class="pc-mtext">Payment History</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Pesan</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mail"></i></span>
                            <span class="pc-mtext">Kotak Pesan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brand-hipchat"></i></span>
                            <span class="pc-mtext">Chat</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="#" class="pc-link bg-transparent"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="pc-micon"><i class="ti ti-power text-danger"></i></span>
                            <span class="pc-mtext text-danger">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif

                @if (Auth::user()->role === 'customer')
                    <li class="pc-item">
                        <a href="{{ route('dashboard-customer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-chart-bar"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('profile-customer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">Profile</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Penawaran</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('search-route') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-world"></i></span>
                            <span class="pc-mtext">Cari Rute</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('request-route') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-location"></i></span>
                            <span class="pc-mtext">Permintaan Rute</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('list-offer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-clipboard"></i></span>
                            <span class="pc-mtext">Daftar Penawaran</span>
                        </a>
                    <li class="pc-item pc-caption">
                        <label>Pemesanan</label>
                        <i class="ti ti-news"></i>
                    </li>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('list-payment') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-cash"></i></span>
                            <span class="pc-mtext">Payment History</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('tracking-customer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-map-2"></i></span>
                            <span class="pc-mtext">Tracking Order</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('review') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-picker"></i></span>
                            <span class="pc-mtext">Daftar Ulasan</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Pesan</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('notification-customer') }}" class="pc-link">
                            <span class="pc-micon position-relative">
                                <i class="ti ti-mail"></i>
                                @php
                                    $unreadNotifications = \App\Models\Notification::where('receiver_id', Auth::id())
                                        ->where('is_read', 0)
                                        ->count();
                                @endphp
                                @if ($unreadNotifications > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger">
                                        {{ $unreadNotifications }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                @endif
                            </span>
                            <span class="pc-mtext">Kotak Pesan</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-message-circle"></i></span>
                            <span class="pc-mtext">Chat</span>
                        </a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Bantuan</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('FAQ-customer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-info-circle"></i></span>
                            <span class="pc-mtext">FAQ</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="{{ route('complain-customer') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-mailbox"></i></span>
                            <span class="pc-mtext">Complains</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="#" class="pc-link bg-transparent"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="pc-micon"><i class="ti ti-power text-danger"></i></span>
                            <span class="pc-mtext text-danger">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif

                {{-- <li class="pc-item pc-caption">
            <label>UI Components</label>
            <i class="ti ti-dashboard"></i>
          </li>
          <li class="pc-item">
            <a href="../elements/bc_typography.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-typography"></i></span>
              <span class="pc-mtext">Typography</span>
            </a>
          </li>
          <li class="pc-item">
            <a href="../elements/bc_color.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
              <span class="pc-mtext">Color</span>
            </a>
          </li>
          <li class="pc-item">
            <a href="../elements/icon-tabler.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
              <span class="pc-mtext">Icons</span>
            </a>
          </li>

          <li class="pc-item pc-caption">
            <label>Pages</label>
            <i class="ti ti-news"></i>
          </li>
          <li class="pc-item">
            <a href="../pages/login.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-lock"></i></span>
              <span class="pc-mtext">Login</span>
            </a>
          </li>
          <li class="pc-item">
            <a href="../pages/register.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
              <span class="pc-mtext">Register</span>
            </a>
          </li>

          <li class="pc-item pc-caption">
            <label>Other</label>
            <i class="ti ti-brand-chrome"></i>
          </li>
          <li class="pc-item pc-hasmenu">
            <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Menu
                levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
            <ul class="pc-submenu">
              <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                <ul class="pc-submenu">
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                  <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                <ul class="pc-submenu">
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                  <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                  <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                      <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="pc-item">
            <a href="../other/sample-page.html" class="pc-link">
              <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
              <span class="pc-mtext">Sample page</span>
            </a>
          </li>
        </ul>
        <div class="card text-center">
          <div class="card-body">
            <img src="../assets/images/img-navbar-card.png" alt="images" class="img-fluid mb-2">
            <h5>Upgrade To Pro</h5>
            <p>To get more features and components</p>
            <a href="https://codedthemes.com/item/berry-bootstrap-5-admin-template/" target="_blank"
            class="btn btn-success">Buy Now</a>
          </div>
        </div> --}}
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
