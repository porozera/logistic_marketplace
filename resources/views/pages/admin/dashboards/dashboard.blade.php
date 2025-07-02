@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pc-container">
  <div class="pc-content">      
          <!-- [ Main Content ] start -->
          
          {{-- <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-12">
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                      <li class="breadcrumb-item"><a href="javascript: void(0)">Widget</a></li>
                      <li class="breadcrumb-item" aria-current="page">Chart</li>
                    </ul>
                  </div>
                  <div class="col-md-12">
                    <div class="page-header-title">
                      <h2 class="mb-0">Chart</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="row">
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                  <h4 class="mb-0">78,250 <span class="badge bg-light-primary border border-primary"><i
                        class="ti ti-trending-up"></i> 70.5%</span></h4>
                </div>
                <div id="total-value-graph-1"></div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
                  <h4 class="mb-0">18,800 <span class="badge bg-light-warning border border-warning"><i
                        class="ti ti-trending-down"></i> 27.4%</span></h4>
                </div>
                <div id="total-value-graph-2"></div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">Total Sales</h6>
                  <h4 class="mb-0">$35,078 <span class="badge bg-light-warning border border-warning"><i
                        class="ti ti-trending-down"></i> 27.4%</span></h4>
                </div>
                <div id="total-value-graph-3"></div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">Total Marketing</h6>
                  <h4 class="mb-0">4,42,236 <span class="badge bg-light-primary border border-primary"><i
                        class="ti ti-trending-up"></i> 59.3%</span></h4>
                </div>
                <div id="total-value-graph-4"></div>
              </div>
            </div>
    
            <div class="col-md-12 col-xl-7">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">Unique Visitor</h5>
                <ul class="nav nav-pills justify-content-end mb-0" id="chart-tab-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="chart-tab-home-tab" data-bs-toggle="pill" data-bs-target="#chart-tab-home"
                      type="button" role="tab" aria-controls="chart-tab-home" aria-selected="true">Month</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="chart-tab-profile-tab" data-bs-toggle="pill"
                      data-bs-target="#chart-tab-profile" type="button" role="tab" aria-controls="chart-tab-profile"
                      aria-selected="false">Week</button>
                  </li>
                </ul>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="tab-content" id="chart-tab-tabContent">
                    <div class="tab-pane" id="chart-tab-home" role="tabpanel" aria-labelledby="chart-tab-home-tab"
                      tabindex="0">
                      <div id="visitor-chart-1"></div>
                    </div>
                    <div class="tab-pane show active" id="chart-tab-profile" role="tabpanel"
                      aria-labelledby="chart-tab-profile-tab" tabindex="0">
                      <div id="visitor-chart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xl-5">
              <h5 class="mb-3">Income Overview</h5>
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                  <h3 class="mb-3">$7,650</h3>
                  <div id="income-overview-chart"></div>
                </div>
              </div>
            </div>
    
            <div class="col-md-12 col-xl-4">
              <h5 class="mb-3">Analytics Report</h5>
              <div class="card">
                <div class="list-group list-group-flush">
                  <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                    Finance Growth<span class="h5 mb-0">+45.14%</span></a>
                  <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">Company
                    Expenses Ratio<span class="h5 mb-0">0.58%</span></a>
                </div>
                <div class="card-body px-2">
                  <div id="analytics-report-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xl-8">
              <h5 class="mb-3">Income Overview</h5>
              <div class="card">
                <div class="card-body">
                  <div class="row mb-3 align-items-center">
                    <div class="col">
                      <p class="mb-1 text-danger">$1,12,900 (45.67%)</p>
                      <p class="mb-1 text-muted">Compare to : 01 Dec 2021-08 Jan 2022</p>
                    </div>
                    <div class="col-auto">
                      <ul class="nav nav-pills justify-content-end mb-0" id="income-tab-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="income-tab-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#income-tab-profile" type="button" role="tab" aria-controls="income-tab-profile"
                            aria-selected="false">Week</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="income-tab-home-tab" data-bs-toggle="pill"
                            data-bs-target="#income-tab-home" type="button" role="tab" aria-controls="income-tab-home"
                            aria-selected="true">Month</button>
                        </li>
                      </ul>
                    </div>
                    <div class="col-auto">
                      <select class="form-select p-r-35">
                        <option>By Volume</option>
                        <option>By Margin</option>
                        <option>By Sales</option>
                      </select>
                    </div>
                    <div class="col-auto">
                      <a href="#" class="avtar avtar-s btn btn-outline-secondary">
                        <i class="ti ti-download f-18"></i>
                      </a>
                    </div>
                  </div>
                  <div class="tab-content" id="income-tab-tabContent">
                    <div class="tab-pane show active" id="income-tab-profile" role="tabpanel"
                      aria-labelledby="income-tab-profile-tab" tabindex="0">
                      <div id="income-overview-tab-chart"></div>
                    </div>
                    <div class="tab-pane" id="income-tab-home" role="tabpanel" aria-labelledby="income-tab-home-tab"
                      tabindex="0">
                      <div id="income-overview-tab-chart-1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    
            <div class="col-md-12 col-xl-7">
              <h5 class="mb-3">Sales Report</h5>
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-2 f-w-400 text-muted">This Week Statistics</h6>
                  <h3 class="mb-0">$7,650</h3>
                  <div id="sales-report-chart"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xl-5">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="mb-2">Acquisition Channels</h6>
                      <p class="mb-0 text-muted">Marketing</P>
                    </div>
                    <h4 class="text-primary">-128</h4>
                  </div>
                  <div id="acquisition-chart"></div>
                </div>
                <div class="list-group list-group-flush">
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div class="avtar avtar-s rounded-circle text-secondary bg-light-secondary">
                          <i class="ti ti-device-analytics f-18"></i>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Top Channels</h6>
                        <p class="mb-0 text-muted">Today, 2:00 AM</P>
                      </div>
                      <div class="flex-shrink-0 text-end">
                        <h6 class="mb-1">+ $1,430</h6>
                        <p class="mb-0 text-muted">35%</P>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <div class="avtar avtar-s rounded-circle text-primary bg-light-primary">
                          <i class="ti ti-file-text f-18"></i>
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">Top Pages</h6>
                        <p class="mb-0 text-muted">Today 6:00 AM</P>
                      </div>
                      <div class="flex-shrink-0 text-end">
                        <h6 class="mb-1">- $1430</h6>
                        <p class="mb-0 text-muted">35%</P>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            </div>
          </div> --}}
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0 mt-2">Dashboard</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-lg-6 col-md-6">
            <a href="{{ route('admin.customer.index') }}" style="text-decoration: none; color: inherit;">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-1">{{ $totalCustomer }}</h3>
                      <p class="text-muted mb-0">Total Customer</p>
                    </div>
                    <div class="col-4 text-end">
                      <i class="ti ti-users text-info f-36"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          
          <div class="col-lg-6 col-md-6">
            <a href="{{ route('admin.lsp.index') }}" style="text-decoration: none; color: inherit;">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-1">{{ $totalLsp }}</h3>
                      <p class="text-muted mb-0">Total Logistic Service Provider (LSP)</p>
                    </div>
                    <div class="col-4 text-end">
                      <i class="ti ti-building-warehouse text-warning f-36"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          
          <div class="col-lg-6 col-md-6">
            <a href="{{ route('admin.shipment.index') }}" style="text-decoration: none; color: inherit;">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-1">{{ $totalOrder }}</h3>
                      <p class="text-muted mb-0">Total Pesanan</p>
                    </div>
                    <div class="col-4 text-end">
                      <i class="ti ti-truck-delivery text-success f-36"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          
          <div class="col-lg-6 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-1">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Total Transaksi</p>
                  </div>
                  <div class="col-4 text-end">
                    <i class="ti ti-report-money text-primary f-36"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          {{-- <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card bg-primary">
              <div class="card-body">
                <h3 class="text-white m-0">1165 +</h3>
                <span class="m-t-10">Facebook Users</span>
                <i class="fab fa-facebook"></i>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card bg-info">
              <div class="card-body">
                <h3 class="text-white m-0">780 +</h3>
                <span class="m-t-10">Twitter Users</span>
                <i class="fab fa-twitter"></i>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card bg-dark">
              <div class="card-body">
                <h3 class="text-white m-0">998 +</h3>
                <span class="m-t-10">Linked In Users</span>
                <i class="fab fa-linkedin-in"></i>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card social-widget-card bg-danger">
              <div class="card-body">
                <h3 class="text-white m-0">650 +</h3>
                <span class="m-t-10">Youtube Videos</span>
                <i class="fab fa-youtube"></i>
              </div>
            </div>
          </div> --}}

          {{-- <div class="col-xl-4 col-md-12">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="m-b-20">Impressions</h5>
                    <h3>1,563</h3>
                    <p class="m-b-0">May 23 - June 01 (2018)</p>
                  </div>
                  <div class="col-auto">
                    <i class="ti ti-eye bg-light-primary text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="m-b-20">Goal</h5>
                    <h3>30,564</h3>
                    <p class="m-b-0">May 28 - June 01 (2018)</p>
                  </div>
                  <div class="col-auto">
                    <i class="ti ti-target bg-light-success text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card comp-card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col">
                    <h5 class="m-b-20">Impact</h5>
                    <h3>42.6%</h3>
                    <p class="m-b-0">May 30 - June 01 (2018)</p>
                  </div>
                  <div class="col-auto">
                    <i class="ti ti-clock bg-light-warning text-warning"></i>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

          {{-- <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Total Page Views</h6>
                <h4 class="mb-3"
                  >4,42,236 <span class="badge bg-light-primary border border-primary"><i class="ti ti-trending-up"></i> 59.3%</span></h4
                >
                <p class="mb-0 text-muted text-sm">You made an extra <span class="text-primary">35,000</span> this year </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                <h4 class="mb-3"
                  >78,250 <span class="badge bg-light-success border border-success"><i class="ti ti-trending-up"></i> 70.5%</span></h4
                >
                <p class="mb-0 text-muted text-sm">You made an extra <span class="text-success">8,900</span> this year</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Total Order</h6>
                <h4 class="mb-3"
                  >18,800 <span class="badge bg-light-warning border border-warning"><i class="ti ti-trending-down"></i> 27.4%</span></h4
                >
                <p class="mb-0 text-muted text-sm">You made an extra <span class="text-warning">1,943</span> this year</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <h6 class="mb-2 f-w-400 text-muted">Total Sales</h6>
                <h4 class="mb-3"
                  >$35,078 <span class="badge bg-light-danger border border-danger"><i class="ti ti-trending-down"></i> 27.4%</span></h4
                >
                <p class="mb-0 text-muted text-sm">You made an extra <span class="text-danger">$20,395</span> this year </p>
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-sm-4">
            <div class="card bg-success text-white widget-visitor-card">
              <div class="card-body text-center">
                <h2 class="text-white">1,658</h2>
                <p class="text-white mb-0">Daily user</p>
                <i class="ti ti-users d-block f-46 text-white"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card bg-primary text-white widget-visitor-card">
              <div class="card-body text-center">
                <h2 class="text-white">1K</h2>
                <p class="text-white mb-0">Daily page view</p>
                <i class="ti ti-world d-block f-46 text-white"></i>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card bg-danger text-white widget-visitor-card">
              <div class="card-body text-center">
                <h2 class="text-white">5,678</h2>
                <p class="text-white mb-0">Last month visitor</p>
                <i class="ti ti-calendar-stats d-block f-46 text-white"></i>
              </div>
            </div>
          </div> --}}
          {{-- <div class="col-xl-6">
            <div class="card">
              <div class="row g-0">
                <div class="col-md-6">
                  <div class="card-body bg-primary position-relative h-100">
                    <h6 class="text-white">What would you want to learn today</h6>
                    <p class="text-white text-sm mb-4">Your learning capacity is 80% as daily analytics</p>
                    <div class="row align-items-end">
                      <div class="col-7">
                        <h4 class="text-white">35% Completed</h4>
                        <div class="progress bg-light-success">
                          <div class="progress-bar bg-success" style="width: 40%"></div>
                        </div>
                      </div>
                      <div class="col-5">
                        <img src="../assets/images/widget/reader.svg" alt="img" class="img-fluid img-reader">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body">
                    <p class="mb-2">Get started with new basic skills</p>
                    <p class="text-muted mb-3">Last Date 5th Nov 2020</p>
                    <hr class="my-3">
                    <div class="d-flex align-items-center justify-content-between my-3">
                      <div class="user-group">
                        <img src="../assets/images/user/avatar-1.jpg" alt="image">
                        <img src="../assets/images/user/avatar-2.jpg" alt="image">
                        <img src="../assets/images/user/avatar-3.jpg" alt="image">
                      </div>
                      <a href="#" class="avtar avtar-xs btn btn-primary">
                        <i class="ti ti-plus f-18"></i>
                      </a>
                    </div>
                    <p class="text-muted text-sm mb-0">Chrome fixed the bug several versions ago, thus rendering this... </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center my-2">
                  <div class="col-5">
                    <p class="mb-0">Published Project</p>
                  </div>
                  <div class="col">
                    <div class="progress progress-primary">
                      <div class="progress-bar" style="width: 30%"></div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <p class="mb-0 text-sm text-muted">30%</p>
                  </div>
                </div>
                <div class="row align-items-center my-2">
                  <div class="col-5">
                    <p class="mb-0">Completed Task</p>
                  </div>
                  <div class="col">
                    <div class="progress progress-success">
                      <div class="progress-bar" style="width: 90%"></div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <p class="mb-0 text-sm text-muted">90%</p>
                  </div>
                </div>
                <div class="row align-items-center my-2">
                  <div class="col-5">
                    <p class="mb-0">Pending Task</p>
                  </div>
                  <div class="col">
                    <div class="progress progress-danger">
                      <div class="progress-bar" style="width: 50%"></div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <p class="mb-0 text-sm text-muted">50%</p>
                  </div>
                </div>
                <div class="row align-items-center my-2">
                  <div class="col-5">
                    <p class="mb-0">Issues</p>
                  </div>
                  <div class="col">
                    <div class="progress progress-warning">
                      <div class="progress-bar" style="width: 55%"></div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <p class="mb-0 text-sm text-muted">55%</p>
                  </div>
                </div>
                <hr class="my-4">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <img src="../assets/images/widget/target.svg" alt="img" class="img-fluid">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h6>Income Salaries & Budget</h6>
                    <p class="text-muted mb-0">All your income salaries and budget comes here, you can track them or manage them</p>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="col-md-12 col-xl-12">
            <h5 class="mb-3">Recent Orders</h5>
            <div class="card tbl-card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <div class="d-flex justify-content-start mb-3">
                      <a href="{{ route('admin.shipment.index') }}" class="btn btn-primary">
                          <i class="ti ti-truck-delivery me-1"></i> Lihat Detail
                      </a>
                  </div>
                    <thead>
                        <tr>
                            <th class="text-center">NO. Offer</th>
                            <th class="text-center">PERUSAHAAN</th>
                            <th class="text-center">ASAL</th>
                            <th class="text-center">TUJUAN</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse ($recentOrders as $order)
                          <tr>
                              <td class="text-center">
                                  <a href="#" class="text-muted">{{ $order->noOffer }}</a>
                              </td>
                              <td class="text-center">{{ $order->lsp->companyName ?? '-' }}</td>
                              <td class="text-center">{{ $order->origin }}</td>
                              <td class="text-center">{{ $order->destination }}</td>
                              <td class="text-center">
                                  @php
                                      $badgeClass = match($order->status) {
                                          'Loading Item' => 'bg-light-warning',
                                          'On The Way' => 'bg-light-primary',
                                          'Finished' => 'bg-light-success',
                                          default => 'bg-light-secondary'
                                      };
                                  @endphp
                                  <span class="badge {{ $badgeClass }} rounded-pill f-12">
                                      {{ $order->status }}
                                  </span>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="5" class="text-center">No recent orders available.</td>
                          </tr>
                      @endforelse
                  </tbody>
                </table>
                
                </div>
              </div>
            </div>
          </div>
        </div>
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

<!-- [Page Specific JS] start -->
<!-- Apex Chart -->
<script src="{{ asset('template/mantis/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('template/mantis/dist/assets/js/pages/w-chart.js') }}"></script>
<!-- [Page Specific JS] end -->


@endsection