@extends('layouts.app')

@section('title', 'Add Route')

@section('content')
    <div class="container" style="padding-left: 250px; padding-top:80px;">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Route</a></li>
                            <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Create Route</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
                <h5>Form Tambah Route</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('offers.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="origin" class="form-label">Provinsi Asal</label>
                        <select id="origin_province" class="form-control"></select>
                    </div>

                    <div class="mb-3">
                        <label for="origin" class="form-label">Kota Asal</label>
                        <select name="origin" id="origin_city" class="form-control"></select>
                        @error('origin')
                            <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Provinsi Tujuan</label>
                        <select id="destination_province" class="form-control"></select>
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Kota Tujuan</label>
                        <select name="destination" id="destination_city" class="form-control"></select>
                        @error('destination') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror

                    </div>

                    <div class="mb-3">
                        <label for="shipmentMode" class="form-label">Shipment Mode</label>
                        <select name="shipmentMode" class="form-control" required>
                            <option value="D2D">D2D</option>
                            <option value="D2P">D2P</option>
                            <option value="P2D">P2D</option>
                            <option value="P2P">P2P</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="shipmentType" class="form-label">Shipment Type</label>
                        <select name="shipmentType" class="form-control" required>
                            <option value="FCL">FCL</option>
                            <option value="LCL">LCL</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        {{-- <label for="container">Pilih Jenis Container</label>
                        <select name="container" class="form-control" id="container">
                            @foreach ($containers as $container)
                                <option value="{{ $container->id }}">{{ $container->name }} - </option>
                            @endforeach
                        </select> --}}

                        <label for="container">Pilih Jenis Container</label>
                            <select name="container_id" class="form-control" id="container">
                                <option value="">-- Pilih Container --</option>
                                @foreach ($containers as $container)
                                    <option
                                        value="{{ $container->id }}"
                                        data-weight="{{ $container->weight }}"
                                        data-volume="{{ $container->volume }}"
                                        data-description="{{ $container->description }}"
                                    >
                                        {{ $container->name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                    <div id="container-info" class="card p-3 mt-3" style="display: none;">
                        <h5>Detail Container</h5>
                        <hr>
                        <p><strong>Berat Maksimal:</strong> <span id="max-weight"></span> Kg</p>
                        <p><strong>Volume Maksimal:</strong> <span id="max-volume"></span> CBM</p>
                        <p><strong>Deskripsi:</strong> <span id="container-description"></span></p>

                        <!-- Input hidden untuk dikirim ke backend -->
                        <input type="hidden" name="maxWeight" id="maxWeightInput">
                        <input type="hidden" name="maxVolume" id="maxVolumeInput">
                        <input type="hidden" name="remainingWeight" id="remainingWeightInput">
                        <input type="hidden" name="remainingVolume" id="remainingVolumeInput">
                    </div>

                    {{-- <div class="mb-3">
                        <label for="maxWeight" class="form-label">Max Weight</label>
                        <input type="number" name="maxWeight" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="maxVolume" class="form-label">Max Volume</label>
                        <input type="number" name="maxVolume" class="form-control" required>
                    </div> --}}

                    <div class="mb-3">
                        <label for="commodities" class="form-label">Commodities</label>
                        {{-- <input type="text" name="commodities" class="form-control"> --}}
                        <select class="form-select" name="commodities" id="commodities">
                            <option value="">-- Pilih Commodities --</option>
                            @foreach ($commodities as $commodity)
                                <option value="{{ $commodity->name }}">{{ $commodity->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        {{-- <input type="number" name="price" class="form-control" step="0.01" required> --}}
                        <input type="text" class="form-control" id="price_display" placeholder="Masukkan harga" required>
                        <input type="hidden" name="price" id="price">
                    </div>

                    <div class="mb-3">
                        <label for="loadingDate" class="form-label">Loading Date</label>
                        <input type="date" name="loadingDate" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="shippingDate" class="form-label">Shipping Date</label>
                        <input type="date" name="shippingDate" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="estimationDate" class="form-label">Estimation Date</label>
                        <input type="date" name="estimationDate" class="form-control" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="remainingWeight" class="form-label">Remaining Weight</label>
                        <input type="number" name="remainingWeight" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="remainingVolume" class="form-label">Remaining Volume</label>
                        <input type="number" name="remainingVolume" class="form-control">
                    </div> --}}

                    <div class="mb-3">
                        <label for="truck_first_id" class="form-label">First Truck</label>
                        <select class="form-select" name="truck_first_id" id="truck_first_id" required>
                            <option value="">-- Pilih Truk --</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}">{{ $truck->type }} - {{ $truck->brand }} -
                                    {{ $truck->plateNumber }} ({{ $truck->driverName }}) </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="truck_second_id" class="form-label">Second Truck</label>
                        <select class="form-select" name="truck_second_id" id="truck_second_id" required>
                            <option value="">-- Pilih Truk --</option>
                            @foreach ($trucks as $truck)
                                <option value="{{ $truck->id }}">{{ $truck->type }} - {{ $truck->brand }} -
                                    {{ $truck->plateNumber }} ({{ $truck->driverName }}) </option>
                            @endforeach
                        </select>
                    </div>

                    <hr>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Offer</button>
                </form>

            </div>
        </div>

    </div>

    <script>
        // Load provinsi saat halaman pertama kali dibuka
        const loadProvinces = async (selectId) => {
            const res = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
            const provinces = await res.json();
            const select = document.getElementById(selectId);
            select.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(p => {
                select.innerHTML += `<option value="${p.id}">${p.name}</option>`;
            });
        }

        // Load kota/kabupaten berdasarkan provinsi
        const loadCities = async (provinceId, targetSelectId) => {
            const res = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`);
            const cities = await res.json();
            const select = document.getElementById(targetSelectId);
            select.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            cities.forEach(c => {
                select.innerHTML += `<option value="${c.name}">${c.name}</option>`;
            });
        }

        // Load provinsi saat awal
        window.addEventListener("DOMContentLoaded", () => {
            loadProvinces("origin_province");
            loadProvinces("destination_province");

            // Event Listener untuk load kota berdasarkan provinsi
            document.getElementById("origin_province").addEventListener("change", function () {
                loadCities(this.value, "origin_city");
            });

            document.getElementById("destination_province").addEventListener("change", function () {
                loadCities(this.value, "destination_city");
            });
        });

        document.getElementById('container').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const weight = selectedOption.getAttribute('data-weight');
            const volume = selectedOption.getAttribute('data-volume');
            const description = selectedOption.getAttribute('data-description');

            if (weight && volume) {
                // Tampilkan container info
                document.getElementById('container-info').style.display = 'block';
                document.getElementById('max-weight').textContent = weight;
                document.getElementById('max-volume').textContent = volume;
                document.getElementById('container-description').textContent = description;

                // Set input hidden
                document.getElementById('maxWeightInput').value = weight;
                document.getElementById('maxVolumeInput').value = volume;
                document.getElementById('remainingWeightInput').value = weight;
                document.getElementById('remainingVolumeInput').value = volume;
            } else {
                document.getElementById('container-info').style.display = 'none';
            }
        });
    </script>
    <script>
        document.getElementById("price_display").addEventListener("input", function(e) {
            let input = this.value.replace(/\D/g, ''); // ambil angka aja
            this.value = formatRupiah(input); // tampilkan yang sudah diformat
            document.getElementById("price").value = input; // simpan angka murni ke hidden input
        });

        function formatRupiah(angka) {
            let number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
        </script>


@endsection
