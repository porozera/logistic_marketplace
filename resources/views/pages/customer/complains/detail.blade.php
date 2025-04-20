@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Detail Complain')
@section('content')
 <!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Complains</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Complain</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Detail Complain</h3>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-primary mt-2">{{$complain->created_at}}</p>
                                    @if ($complain->is_answered == false)
                                    <div>
                                        <button type="button" class="btn btn-warning d-inline-flex rounded-pill w-10"><i class="ti ti-clock me-1"></i> Pending</button>
                                    </div>
                                    @else
                                    <div>
                                        <button type="button" class="btn btn-success d-inline-flex rounded-pill w-10"><i class="ti ti-check"></i> Answered</button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <h5>Header</h5>
                        <div class="card">
                            <div class="card-body">
                                <p>{{$complain->header}}</p>
                            </div>
                        </div>
                        <h5>Deskripsi</h5>
                        <div class="card">
                            <div class="card-body">
                                <p>{{$complain->description}}</p>
                            </div>
                        </div>
                        <h5>Jawaban</h5>
                        <div class="card">
                            <div class="card-body">
                                <p>{{$complain->answer}}</p>
                            </div>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3 w-100">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
    </div>
</div>
  <!-- [ Main Content ] end -->

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin membuat komplain ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Kirim Complain</button>
                    </div>
                </div>
            </div>
        </div>

        
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('complainAddForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        </script>
        <script>
            setTimeout(function () {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); 
                }
            }, 5000);
        </script>
@endsection