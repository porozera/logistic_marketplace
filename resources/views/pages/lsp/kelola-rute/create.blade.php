@extends('layouts.app')

@section('title', 'Add Route')
<head>
    <style>
    .accordion-button::after {
        display: none !important;
    }
</style>
</head>

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
                            <option value="D2D">Door to Door (D2D)</option>
                            <option value="D2P">Door to Port(D2P)</option>
                            <option value="P2D">Port to Door(P2D)</option>
                            <option value="P2P">Port to Port(P2P)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="transportationMode" class="form-label">Transportation Mode</label>
                        <select name="transportationMode" class="form-control" required>
                            <option value="darat">Darat</option>
                            <option value="laut">Laut</option>
                        </select>
                    </div>

                    <div class="mb-3" id="pickupDate">
                        <label for="pickupDate" class="form-label">Pickup Date</label>
                        <input type="date" class="form-control" placeholder="Masukkan pickup date" name="pickupDate" required >
                    </div>

                    <div class="mb-3" id="departureDate">
                        <label for="departureDate" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" placeholder="Masukkan departure date" name="departureDate" required >
                    </div>

                    <div id="port-section" class="accordion mb-3" style="display: none;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" aria-expanded="true" aria-controls="collapseOne">
                                    Data pelabuhan
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="mb-3" id="form-port-origin" style="display: block;">
                                        <label for="portOrigin" class="form-label">Pelabuhan Asal (Origin Port)</label>
                                        <input type="text" class="form-control" placeholder="Masukkan pelabuhan asal" name="portOrigin" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="portDestination" class="form-label">Pelabuhan Tujuan (Destination Port)</label>
                                        <input type="text" class="form-control" placeholder="Masukkan pelabuhan tujuan" name="portDestination" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="cyClosingDate" class="form-label">Container Yard Closing Date</label>
                                        <input type="date" class="form-control" placeholder="Masukkan cyClosingDate" name="cyClosingDate">
                                        <label for="etd" class="text-primary">*barang sampai di container yard</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="etd" class="form-label">Estimated Time Departure (ETD)</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETD" name="etd" id="etd">
                                        <label for="etd" class="text-primary">*estimasi keberangkatan kapal</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="eta" class="form-label">Estimated Time Arrival (ETA)</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETA" name="eta" id="eta">
                                        <label for="etd" class="text-primary">*estimasi kedatangan kapal</label>
                                    </div>

                                    <div class="mb-3" id="form-delivery-date">
                                        <label for="deliveryDate" class="form-label">Delivery date</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETA" name="deliveryDate">
                                        <label for="etd" class="text-primary">*pengiriman dari pelabuhan ke tujuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="arrivalDate" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" placeholder="Masukkan arrival date" name="arrivalDate" required id="arrivalDate">
                    </div>

                    <div class="mb-3">
                        <label for="shipmentType" class="form-label">Shipment Type</label>
                        <select name="shipmentType" class="form-control" required>
                            <option value="FCL">FCL</option>
                            <option value="LCL">LCL</option>
                        </select>
                    </div>

                    <div class="mb-3">
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

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        {{-- <input type="number" name="price" class="form-control" step="0.01" required> --}}
                        <input type="text" class="form-control" id="price_display" placeholder="Masukkan harga" required>
                        <input type="hidden" name="price" id="price">
                    </div>

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

        {{-- buat bikin ETA = Arrival date --}}
        {{-- <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const etaInput = document.getElementById('eta');
                    const arrivalInput = document.getElementById('arrivalDate');

                    etaInput.addEventListener('input', function () {
                        arrivalInput.value = etaInput.value;
                    });
                });
        </script> --}}

        {{-- form pelabuhan --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const transportationSelect = document.querySelector('select[name="transportationMode"]');
                const shipmentSelect = document.querySelector('select[name="shipmentMode"]');
                const portSection = document.getElementById('port-section');
                const portOrigin = document.getElementById('form-port-origin');
                const deliveryDate = document.getElementById('form-delivery-date');
                const etaInput = document.getElementById('eta');
                const arrivalInput = document.getElementById('arrivalDate');
                const etdInput = document.getElementById('etd');
                const departureDate = document.getElementById('departureDate');
                const pickupDate = document.getElementById('pickupDate');

                // Fungsi untuk toggle tampilan port
                const togglePortSection = () => {
                    if (transportationSelect.value === 'laut' && shipmentSelect.value === 'D2D' ) {
                        portSection.style.display = 'block';
                        portOrigin.style.display = 'block';
                        deliveryDate.style.display = 'block';
                        arrivalInput.disabled = false;
                        pickupDate.style.display = 'block';
                        departureDate.style.display = 'block';
                    }else if (transportationSelect.value === 'darat' && shipmentSelect.value === 'D2D'){
                        portSection.style.display = 'none';
                        arrivalInput.addEventListener('input', function () {
                        etaInput.value = arrivalInput.value;});
                        departureDate.addEventListener('input', function () {
                        etdInput.value = departureDate.value;});
                        arrivalInput.disabled = false;
                        pickupDate.style.display = 'block';
                        departureDate.style.display = 'block';
                    }else if (shipmentSelect.value === 'D2P') {
                        portSection.style.display = 'block';
                        deliveryDate.style.display = 'none';
                        etaInput.addEventListener('input', function () {
                        arrivalInput.value = etaInput.value;});
                        arrivalInput.disabled = true;
                        pickupDate.style.display = 'block';
                        departureDate.style.display = 'block';
                    }else if (shipmentSelect.value === 'P2P') {
                        portSection.style.display = 'block';
                        deliveryDate.style.display = 'none';
                        etaInput.addEventListener('input', function () {
                        arrivalInput.value = etaInput.value;});
                        arrivalInput.disabled = true;
                        pickupDate.style.display = 'none';
                        departureDate.style.display = 'none';
                    }else if (shipmentSelect.value === 'P2D') {
                        portSection.style.display = 'block';
                        deliveryDate.style.display = 'block';
                        pickupDate.style.display = 'none';
                        departureDate.style.display = 'none';
                        arrivalInput.disabled = false;
                    }
                };

                // Cek saat halaman dimuat
                togglePortSection();

                // Event saat dropdown diubah
                transportationSelect.addEventListener('change', togglePortSection);
                shipmentSelect.addEventListener('change', togglePortSection);
            });
        </script>



@endsection
