@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/report-customer') }}">Customer</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Data</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Data Customer</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Data Customer</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ $customer->username }}" required>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="form-label">Nama Depan</label>
                                <input type="text" name="firstName" id="firstName" class="form-control" value="{{ $customer->firstName }}">
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="form-label">Nama Belakang</label>
                                <input type="text" name="lastName" id="lastName" class="form-control" value="{{ $customer->lastName }}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea name="address" id="address" class="form-control" rows="3">{{ $customer->address }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="accountName" class="form-label">Nama Akun Bank</label>
                                <input type="text" name="accountName" id="accountName" class="form-control" value="{{ $customer->accountName }}">
                            </div>
                            <div class="form-group">
                                <label for="accountNumber" class="form-label">Nomor Rekening</label>
                                <input type="text" name="accountNumber" id="accountNumber" class="form-control" value="{{ $customer->accountNumber }}">
                            </div>
                            <div class="form-group">
                                <label for="telpNumber" class="form-label">No. Telepon</label>
                                <input type="text" name="telpNumber" id="telpNumber" class="form-control" value="{{ $customer->telpNumber }}">
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ $customer->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
