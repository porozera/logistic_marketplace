@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Kotak Pesan Admin')
@section('content')
<!-- [ Main Content ] start -->
<div class="pc-container">
  <div class="pc-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Notifikasi</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
      <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center w-100">
              <h4 class="mb-0">Notifikasi</h4>
              <div class="d-flex align-items-center">
                <form action="{{ route('admin.notifications.markAllAsRead') }}" method="POST" class="me-2 mt-3">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn btn-link p-0">Tandai semua telah dibaca</button>
                </form>
                <i class="ti ti-x"></i>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12">

                @if(session('success'))
                <div class="alert alert-success" id="success-alert">
                  {{ session('success') }}
                </div>
                @endif

                @if($notifications->isEmpty())
                <div class="alert alert-primary text-center">
                  Tidak ada notifikasi baru.
                </div>
                @endif

                @foreach ($notifications as $item)
                @if ($item->is_read == 0)
                <div class="alert mb-0 d-flex justify-content-between align-items-center" style="background-color: #EDF3FF;">
                  <div class="d-flex align-items-center">
                    <img src="{{ $item->sender?->profilePicture ? asset('storage/' . $item->sender->profilePicture) : asset('default-profile.jpg') }}"
                      alt="profile"
                      class="user-avtar wid-35 rounded-circle border me-3"
                      style="object-fit: cover; width: 35px; height: 35px;">
                    <div class="d-flex flex-column">
                      <h5 class="mb-1">{{ $item->header }}</h5>
                      <p class="text-gray-600 mb-0">{!! $item->description !!}</p>
                    </div>
                  </div>
                  <div class="text-end">
                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                    <form action="{{ route('admin.notifications.markAsRead', $item->id) }}" method="POST" class="mt-2">
                      @csrf
                      @method('PUT')
                      <div class="mt-2 d-flex gap-2 align-items-center">
                        @if ($item->type === 'approval_lsp')
                          <a href="{{ route('admin.approval-lsp.detail', $item->related_id) }}" class="btn btn-sm text-white" style="background-color: #198754;">
                            Lihat Detail
                          </a>
                        @elseif ($item->type === 'complaint')
                          <a href="{{ route('admin.complain.detail', $item->related_id) }}" class="btn btn-sm text-white" style="background-color: #198754;">
                            Lihat Detail
                          </a>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary">Tandai telah dibaca</button>
                      </div>

                    </form>
                  </div>
                </div>
                <hr class="mt-0 mb-0 text-gray-600">
                @else
                <div class="alert mb-0 mt-0 d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <img src="{{ $item->sender?->profilePicture ? asset('storage/' . $item->sender->profilePicture) : asset('default-profile.jpg') }}"
                      alt="profile"
                      class="user-avtar wid-35 rounded-circle border me-3"
                      style="object-fit: cover; width: 35px; height: 35px;">
                    <div class="d-flex flex-column">
                      <h5 class="mb-1">{{ $item->header }}</h5>
                      <p class="text-gray-600 mb-0">{!! $item->description !!}</p>
                    </div>
                  </div>
                  <div class="text-end">
                    <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                    <form action="{{ route('admin.notifications.delete', $item->id) }}" method="POST" class="mt-2">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-icon btn-light-danger ms-1"><i class="ti ti-trash"></i></button>
                    </form>
                  </div>
                </div>
                <hr class="mt-0 mb-0 text-gray-600">
                @endif
                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin mengirim permintaan ini?
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
    document.getElementById('requestRouteAddForm')?.submit();
  });

  setTimeout(function () {
    let success = document.getElementById('success-alert');
    if(success) success.style.display = 'none';
  }, 3000);
</script>
@endsection
