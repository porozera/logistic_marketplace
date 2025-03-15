@extends('layouts.app')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- Form untuk Edit Profile -->
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Banner -->
                <div class="card">
                    <div class="card-body text-center">
                        <label for="bannerPicture" class="form-label">Banner Picture</label>
                        <input type="file" id="bannerPicture" name="bannerPicture" class="form-control mb-3">
                        @if($user->bannerPicture)
                            <img src="{{ asset('storage/' . $user->bannerPicture) }}" alt="Banner"
                                class="img-fluid rounded" style="max-height: 300px;">
                        @else
                            <p class="text-muted">Belum ada banner</p>
                        @endif
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" id="profilePicture" name="profilePicture" class="form-control mb-3">
                        @if($user->profilePicture)
                            <img src="{{ asset('storage/' . $user->profilePicture) }}" alt="Profile"
                                class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;">
                        @else
                            <p class="text-muted">Belum ada foto profil</p>
                        @endif
                        <h3 class="mt-3">{{ $user->companyName ?? 'Nama Perusahaan' }}</h3>
                        <p class="text-muted">Rating: {{ $user->rating ?? 'Belum Ada Rating' }} ★</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description', $user->description) }}</textarea>
                        </div>

                        <!-- Read-only fields -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="telpNumber" class="form-label">Nomor Telepon</label>
                                <input type="text" id="telpNumber" class="form-control" value="{{ $user->telpNumber }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea id="address" class="form-control" readonly>{{ $user->address }}</textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="companyName" class="form-label">Nama Perusahaan</label>
                                <input type="text" id="companyName" class="form-control" value="{{ $user->companyName }}" readonly>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Terapkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
