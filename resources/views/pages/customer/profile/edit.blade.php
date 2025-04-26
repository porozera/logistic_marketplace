@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Edit Profile')
@section('content')
<div class="pc-container">
    <div class="pc-content">
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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Profil Pengguna</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Profil Pengguna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8">
              <h4 class="m-b-10">Edit Profile</h4>
                <form action="/profile/customer/edit/perform" method="POST" id="updateProfileForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center">
                                {{-- <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('default-profile.jpg') }}" alt="profile_picture" width="150" class="img-thumbnail"> --}}
                                <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('default-profile.jpg') }}" alt="Profile Picture"
                                class="rounded-circle border border-light-secondary"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Gambar Profile</label>
                            <input type="file" name="profilePicture" class="form-control" placeholder="Gambar Profile" value="{{ $user->profilePicture }}">
                             @error('profilePicture') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                      <br>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" name="firstName" class="form-control" placeholder="Nama Depan" value="{{ $user->firstName }}">
                                @error('firstName') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" name="lastName" class="form-control" placeholder="Nama Belakang" value="{{ $user->lastName }}">
                                @error('lastName') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                          </div>
  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}">
                                @error('username') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                          </div>
  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="telpNumber" class="form-control" placeholder="No Telepon" value="{{ $user->telpNumber }}">
                                @error('telpNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label class="form-label">Password</label>
                                  <div class="input-group mb-3">
                                      <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                      <input class="form-control" id="password" name="password" placeholder="Password" value="">
                                      <span class="input-group-text">
                                        <i class="ti ti-eye" id="togglePassword" 
                                       style="cursor: pointer"></i>
                                       </span>
                                    </div>
                                  @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                              </div>
                            </div>
                          </div>
  
                          <div class="row">
                            <div class="form-group mb-3">
                              <label class="form-label">Alamat</label>
                              <textarea type="text" name="address" class="form-control" placeholder="Alamat" value="{{ $user->address }}">{{ $user->address }}</textarea>
                              @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
  
                          <div class="row">
                              <div class="col text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Update</button>
                              </div>
                          </div>
                      </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Apakah Anda yakin melakukan perubahan ini?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" id="submitFormButton">Update</button>
          </div>
      </div>
  </div>
</div>

<script>
  document.getElementById('submitFormButton').addEventListener('click', function () {
      // Submit the form
      document.getElementById('updateProfileForm').submit();
  });
</script>

<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
    
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    // toggle the eye icon
    this.classList.toggle('ti-eye');
    this.classList.toggle('ti-eye-off');
    });
</script>
@endsection
