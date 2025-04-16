@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Complains')
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
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0)">Detail Order</a></li> --}}
                            <li class="breadcrumb-item" aria-current="page">Complains</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        

        @if ($complains->isEmpty())
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-xl-6">
                <h3 class="">Complains</h3>
            </div>
        </div>
        @else
        <div class="row justify-content-center mb-3">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Complains</h3>
                    <a href="/complain/create" class="btn btn-primary">Buat Komplain</a>
                </div>
            </div>
        </div>
        @endif

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
            
        @if ($complains->isEmpty())
            <div style="display: flex; justify-content: center; align-items: center;">
                <div class="card text-center p-4 w-50">
                    <div class="card-body">
                        <img src="{{ asset('template/mantis/dist/assets/images/search_icon.png') }}" alt="Search Icon" class="mb-3" style="max-width: 100px;">
                        <h3 class="mb-2">Tidak Ada complain</h3>
                        <p class="text-muted">Jika ada keluhah, silahkan buat Complain!</p>
                        <a href="/complain/create" class="btn btn-primary w-50">Buat Complain</a>
                    </div>
                </div>
            </div>
        @endif
        
        @foreach ($complains as $item )
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-xl-8">
                <div class="card card-hover mb-1">
                    <div class="card-header">
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>{{$item->header}}</h4>
                                <a href="/complain/detail/{{$item->id}}" class="btn btn-icon btn-light-primary"><i class="ti ti-arrow-narrow-right"></i></a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex">
                                <p class="me-3 mt-2 text-primary">{{$item->created_at}}</p>
                                @if ($item->is_answered == false)
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
                </div>
            </div>
        </div>
        @endforeach
        
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
                        Apakah Anda yakin menghapus ulasan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger" id="submitFormButton">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('reviewDeleteForm').submit();
            });
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
@endsection