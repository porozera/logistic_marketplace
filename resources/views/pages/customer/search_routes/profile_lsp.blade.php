@extends('layouts.app')
@section('title', 'Profile LSP')
@section('content')

<!-- Custom CSS -->
<style>
    .stat-card {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 15px 30px;
        border: 1px solid #ccc;
        border-radius: 50px;
        min-width: 250px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        background-color: #f8f9fa;
    }

    .stat-card i {
        font-size: 1.2rem;
    }
</style>
<div class="pc-container">
    <div class="pc-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Banner Section -->
                    <div class="position-relative" style="background: url('{{ asset('storage/' . $lsp->bannerPicture) }}') no-repeat center center; background-size: cover; height: 250px;">
                        <!-- Profile Picture -->
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <img src="{{ asset('storage/' . $lsp->profilePicture) }}" alt="Profile Picture"
                                class="rounded-circle border border-white"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex align-items-center">
                                    <a href="{{ url()->previous() }}" class="text-decoration-none text-dark d-flex align-items-center">
                                        <i class="ti ti-chevron-left" style="font-size: 20px; margin-right: 5px;"></i>
                                        <h5 class="mb-0">Kembali</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 text-center"><h3>{{$lsp->companyName}}</h3></div>
                            <div class="col-4"></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-2x fa-star {{ $i <= $lsp->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    {{-- <span>({{ $lsp->rating }})</span> --}}
                                </div>
                            </div>
                            <div class="col-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <p>({{$totalUlasan}} Ulasan)</p>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 text-center">
                                <p style="font-size: 18px">{{$lsp->description}}</p>
                            </div>
                            <div class="col-2"></div>
                        </div>

                        <br>

                        <div class="row mt-2">
                            <div class="col-4 text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="card rounded-pill w-75">
                                        <div class="card-body py-2">
                                            <p class="mt-3" style="font-size: 16px">1000 Pengiriman Berhasil <i class="ti ti-box text-primary mt-1" style="font-size: 18px"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="card rounded-pill w-75">
                                        <div class="card-body py-2">
                                            <p class="mt-3" style="font-size: 16px">80 Kendaraan Aktif <i class="ti ti-truck text-primary mt-1" style="font-size: 18px"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="card rounded-pill w-75">
                                        <div class="card-body py-2">
                                            <p class="mt-3" style="font-size: 16px">1000 Pengiriman Berhasil <i class="ti ti-box text-primary mt-1" style="font-size: 18px"></i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row mt-2 mb-2">
                            <div class="col-4"></div>
                            <div class="col-4 text-center"><h3>Review Pelanggan</h3></div>
                            <div class="col-4"></div>
                        </div>

                        <br>
                        
                        <div class="row mt-4">
                            @foreach ($reviews as $item)
                            <div class="col-4 text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="card w-75">
                                        <div class="card-body py-2">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <img src="{{ $item->customer->profilePicture ? asset('storage/' . $item->customer->profilePicture) : asset('default-profile.jpg') }}" 
                                                        alt="profile-lsp" 
                                                        class="user-avtar border wid-35 rounded-circle"
                                                        style="object-fit: cover; width: 40px; height: 40px;">
                                                </div>
                                                <div class="col-6 text-start">
                                                    <p class="fw-bold mb-1">{{$item->customer->username}}</p>
                                                    <div class="star-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $item->ratingNumber ? 'text-warning' : 'text-muted' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <p class="text-muted" style="font-size: 0.8rem;">{{ $item->created_at->format('d M') }}</p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-2">
                                                <div class="col-12 text-start">
                                                    <p class="mb-0">{{$item->description}}</p>
                                                </div>
                                            </div>
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
@endsection
