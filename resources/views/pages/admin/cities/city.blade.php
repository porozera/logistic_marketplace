@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container" style="padding-left: 250px; padding-top:80px;">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Kota</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Data Kota</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card table-card">
            <div class="card-body">
              <div class="text-end p-4 pb-0">
                <a href="/admin/city-add" class="btn btn-primary d-inline-flex align-item-center">
                  <i class="ti ti-plus f-18 me-2"></i> Tambah Data
                </a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover" id="pc-dt-simple">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Provinsi</th>
                      <th>Kota</th>
                      <th>Kode Pos</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cities as $item)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                        </div>
                      </td>
                      <td>{{ $item->province->name }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->postalCode }}</td>
                      <td class="text-center">
                        <ul class="list-inline me-auto mb-0">
                          <li class="list-inline-item align-bottom">
                            <a href="{{ url('/admin/city/'.$item->id.'/edit') }}" class="avtar avtar-xs btn-link-primary">
                              <i class="ti ti-edit-circle f-18"></i>
                            </a>
                          </li>
                          <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Delete">
                            <a href="javascript:void(0);" class="avtar avtar-xs btn-link-danger" onclick="confirmDelete({{ $item->id }})">
                                <i class="ti ti-trash f-18"></i>
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    @endforeach


                    
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    
</div>
<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Apakah Anda yakin ingin menghapus data ini?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <form id="deleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: true, // Menampilkan tombol "OK"
                confirmButtonText: "OK", // Label tombol
                confirmButtonColor: "#3085d6", // Warna tombol OK
            });
        @endif
    });
</script>


<script>
  function confirmDelete(id) {
      let form = document.getElementById('deleteForm');
      form.action = "/admin/city/" + id; // Mengatur action form delete
      let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
      deleteModal.show(); // Menampilkan modal
  }
</script>


@endsection
