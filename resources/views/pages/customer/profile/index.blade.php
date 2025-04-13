@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Profile')
@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            
                            
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Profil Pengguna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8">
              <h3 class="m-b-10">Profil Pengguna</h3>
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col text-end">
                          <a href="/profile/edit" class="btn btn-primary"><i class="ti ti-edit"></i><span class="ms-2">Edit</span></a>
                        </div>
                      </div>
                      <div class="row">
                        <div class="text-center">
                          <img src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('default-profile.jpg') }}" alt="profile_picture" width="150" class="img-thumbnail">
                        </div>
                      </div>
                      <br>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label class="form-label">Nama Depan</label>
                              <input type="text" name="firstName" class="form-control" placeholder="Lokasi Asal" value="{{ $user->firstName }}" readonly>
                              @error('firstName') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label class="form-label">Nama Belakang</label>
                              <input type="text" name="lastName" class="form-control" placeholder="Lokasi Asal" value="{{ $user->lastName }}" readonly>
                              @error('lastName') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" name="username" class="form-control" placeholder="Lokasi Asal" value="{{ $user->username }}" readonly>
                              @error('username') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label class="form-label">Email</label>
                              <input type="text" name="email" class="form-control" placeholder="Lokasi Asal" value="{{ $user->email }}" readonly>
                              @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label class="form-label">No Telepon</label>
                              <input type="text" name="telpNumber" class="form-control" placeholder="Lokasi Asal" value="{{ $user->telpNumber }}" readonly>
                              @error('telpNumber') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ $user->password }}" readonly> 
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
                            <textarea type="text" name="address" class="form-control" placeholder="Lokasi Asal" value="{{ $user->address }}" readonly>{{ $user->address }}</textarea>
                            @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
