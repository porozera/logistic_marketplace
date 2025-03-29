@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Kotak Pesan')
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
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Kotak Pesan</li>
                </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12 col-md-12 col-xl-12">
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h4 class="mb-0">Notifikasi</h4>
                    <div class="d-flex align-items-center">
                        <a href="" class="me-2">Mark all as read</a>
                        <i class="ti ti-x"></i>
                    </div>
                </div>     
                <br>           
                <div class="row">
                    <div class="col-sm-12">
                        @foreach ($notifications as $item)
                        <div class="card mb-3 border bg-light">
                            <div class="card-body d-flex align-items-start">
                                <div class="col-6 d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="{{ $item->sender->profilePicture ? asset('storage/' . $item->sender->profilePicture) : asset('default-profile.jpg') }}" 
                                            alt="profile-lsp" 
                                            class="user-avtar wid-35 rounded-circle border">
                                    </div>
                                    <div>
                                        <h5 class="mb-2">{{ $item->header }}</h5>
                                        <p class="mb-2 text-muted">{{ $item->description }}</p>
                                    </div>   
                                </div>
                                <div class="col-6 text-end">
                                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                    <div>
                                        <button class="btn border">Mark as read</button>
                                        {{-- <form action="{{ route('notifications.markAsRead', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-primary">Mark as read</button>
                                        </form> --}}
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        @endforeach
                    </div>   
                </div>

            </div>
          </div>
        </div>
      </div>
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
                        Apakah Anda yakin melakukan permintaan rute ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="submitFormButton">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
            document.getElementById('submitFormButton').addEventListener('click', function () {
                // Submit the form
                document.getElementById('requestRouteAddForm').submit();
            });
        </script>
@endsection