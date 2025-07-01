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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Permintaan Pengiriman</a></li>
                            <li class="breadcrumb-item" aria-current="page">Membuat Penawaran</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Penawaran</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="card">
            <div class="card-header">
                <h5>Ajukan Penawaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bids.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="origin" class="form-label">Kota Asal</label>
                        <input type="text" class="form-control" name="origin" value="{{ $requestRoute->origin }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="destination" class="form-label">Kota Tujuan</label>
                        <input type="text" class="form-control" name="destination" value="{{ $requestRoute->destination }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="shipmentType" class="form-label">Shipment Type</label>
                        <input type="text" class="form-control" name="shipmentType" value="{{ $requestRoute->shipmentType }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="transportationMode" class="form-label">Transportation Mode</label>
                        <input type="text" class="form-control text-capitalize" name="transportationMode" value="{{ $requestRoute->transportationMode }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="shipmentMode" class="form-label">Shipment Mode</label>
                        <input type="text" class="form-control text-capitalize" name="shipmentMode" value="{{ $requestRoute->shipmentMode }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="RTL_start_date" class="form-label">Ready to Load</label>
                        <div class="input-group mb-3">
                            <input type="text" name="RTL_start_date" class="form-control" value="{{ $requestRoute->RTL_start_date }}" readonly>
                            <span class="input-group-text">s/d</span>
                            <input type="text" name="RTL_end_date" class="form-control" value="{{ $requestRoute->RTL_end_date }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3" id="arrivalDate">
                        <label for="arrivalDate" class="form-label">Arrival Date</label>
                        <input type="date" class="form-control" placeholder="Masukkan pickup date" name="arrivalDate" value="{{ $requestRoute->arrivalDate }}" readonly >
                    </div>

                    <div class="mb-3" id="cargoType">
                        <label for="cargoType" class="form-label">Cargo Type</label>
                        <input type="text" class="form-control" placeholder="Masukkan departure date" name="cargoType" value="{{ $requestRoute->cargoType}}" readonly >
                    </div>

                    <div class="mb-3" id="departureDate">
                        <label for="departureDate" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" placeholder="Masukkan departure date" name="departureDate" required >
                    </div>


                    <div class="mb-3">
                        <label for="container">Pilih Jenis Container</label>
                                <select name="container_id" class="form-control" id="container">
                                    <option value="">-- Pilih Container --</option>
                                    @foreach ($containers as $container)
                                        <option value="{{ $container->id }}" data-weight="{{ $container->weight }}" data-volume="{{ $container->volume }}" data-description="{{ $container->description }}">
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
                    {{-- <input type="hidden" name="etd" id="etd_hidden_darat"> --}}

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
                                        <input type="text" class="form-control" placeholder="Masukkan pelabuhan asal" name="portOrigin" id="portOrigin">
                                    </div>

                                    <div class="mb-3">
                                        <label for="portDestination" class="form-label">Pelabuhan Tujuan (Destination Port)</label>
                                        <input type="text" class="form-control" placeholder="Masukkan pelabuhan tujuan" name="portDestination" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="cyClosingDate" class="form-label">Container Yard Closing Date</label>
                                        <input type="date" class="form-control" placeholder="Masukkan cyClosingDate" name="cyClosingDate">
                                        <label for="cyClosingDate" class="text-primary">*barang sampai di container yard</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="etd" class="form-label">Estimated Time Departure (ETD)</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETD" name="etd" id="etd">
                                        <label for="etd" class="text-primary">*estimasi keberangkatan kapal</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="eta" class="form-label">Estimated Time Arrival (ETA)</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETA" name="eta" id="eta">
                                        <label for="eta" class="text-primary">*estimasi kedatangan kapal</label>
                                    </div>

                                    <div class="mb-3" id="form-delivery-date">
                                        <label for="deliveryDate" class="form-label">Delivery date</label>
                                        <input type="date" class="form-control" placeholder="Masukkan ETA" name="deliveryDate">
                                        <label for="deliveryDate" class="text-primary">*pengiriman dari pelabuhan ke tujuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        {{-- <script>
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
            // Tambahkan event listener hanya satu kali
        </script> --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const transportationSelect = document.querySelector('select[name="transportationMode"]');
    const shipmentSelect = document.querySelector('select[name="shipmentMode"]');
    const portSection = document.getElementById('port-section');
    const portOrigin = document.getElementById('form-port-origin');
    const deliveryDate = document.getElementById('form-delivery-date');
    const etaInput = document.getElementById('eta');
    const arrivalInput = document.getElementById('arrivalDate');
    const etdInput = document.getElementById('etd');
    const departureDate = document.querySelector('input[name="departureDate"]');
    const pickupDate = document.getElementById('pickupDate');

    // Event listener hanya sekali!
    arrivalInput.addEventListener('input', function () {
        etaInput.value = arrivalInput.value;
    });
    departureDate.addEventListener('input', function () {
        etdInput.value = departureDate.value;
    });

    const togglePortSection = () => {
        if (transportationSelect.value === 'laut' && shipmentSelect.value === 'D2D' ) {
            portSection.style.display = 'block';
            portOrigin.style.display = 'block';
            deliveryDate.style.display = 'block';
            arrivalInput.disabled = false;
            pickupDate.style.display = 'block';
            departureDate.parentElement.style.display = 'block';
        }else if (transportationSelect.value === 'darat' && shipmentSelect.value === 'D2D'){
            portSection.style.display = 'none';
            arrivalInput.disabled = false;
            pickupDate.style.display = 'block';
            departureDate.parentElement.style.display = 'block';
        }else if (shipmentSelect.value === 'D2P') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'none';
            arrivalInput.disabled = true;
            pickupDate.style.display = 'block';
            departureDate.parentElement.style.display = 'block';
        }else if (shipmentSelect.value === 'P2P') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'none';
            arrivalInput.disabled = true;
            pickupDate.style.display = 'none';
            departureDate.parentElement.style.display = 'none';
        }else if (shipmentSelect.value === 'P2D') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'block';
            pickupDate.style.display = 'none';
            departureDate.parentElement.style.display = 'none';
            arrivalInput.disabled = false;
        }
    };

    // Cek saat halaman dimuat
    togglePortSection();

    // Event saat dropdown diubah
    transportationSelect.addEventListener('change', togglePortSection);
    shipmentSelect.addEventListener('change', togglePortSection);
});

</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Ganti selector ke input karena di HTML menggunakan input readonly, bukan select
    const transportationInput = document.querySelector('input[name="transportationMode"]');
    const shipmentInput = document.querySelector('input[name="shipmentMode"]');
    const portSection = document.getElementById('port-section');
    const portOrigin = document.getElementById('form-port-origin');
    const deliveryDate = document.getElementById('form-delivery-date');
    const etaInput = document.getElementById('eta');
    const arrivalInput = document.getElementById('arrivalDate');
    const etdInput = document.getElementById('etd');
    const departureDate = document.querySelector('input[name="departureDate"]');
    const pickupDate = document.getElementById('pickupDate');

    // Event listener untuk sync tanggal (hanya sekali)
    if (arrivalInput && etaInput) {
        arrivalInput.addEventListener('input', function () {
            etaInput.value = arrivalInput.value;
        });
    }

    if (departureDate && etdInput) {
        departureDate.addEventListener('input', function () {
            etdInput.value = departureDate.value;
        });
    }

    const togglePortSection = () => {
        // Ambil nilai dari input (lowercase untuk konsistensi)
        const transportationMode = transportationInput ? transportationInput.value.toLowerCase() : '';
        const shipmentMode = shipmentInput ? shipmentInput.value.toLowerCase() : '';

        console.log('Transportation Mode:', transportationMode); // Debug
        console.log('Shipment Mode:', shipmentMode); // Debug

        if (transportationMode === 'laut' && shipmentMode === 'd2d') {
            portSection.style.display = 'block';
            portOrigin.style.display = 'block';
            deliveryDate.style.display = 'block';
            arrivalInput.disabled = false;
            if (pickupDate) pickupDate.style.display = 'block';
            if (departureDate) departureDate.parentElement.style.display = 'block';
        } else if (transportationMode === 'darat' && shipmentMode === 'd2d') {
            portSection.style.display = 'none';
            arrivalInput.disabled = false;
            if (pickupDate) pickupDate.style.display = 'block';
            if (departureDate) departureDate.parentElement.style.display = 'block';
        } else if (shipmentMode === 'd2p') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'none';
            arrivalInput.disabled = true;
            if (pickupDate) pickupDate.style.display = 'block';
            if (departureDate) departureDate.parentElement.style.display = 'block';
        } else if (shipmentMode === 'p2p') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'none';
            arrivalInput.disabled = true;
            if (pickupDate) pickupDate.style.display = 'none';
            if (departureDate) departureDate.parentElement.style.display = 'none';
        } else if (shipmentMode === 'p2d') {
            portSection.style.display = 'block';
            deliveryDate.style.display = 'block';
            if (pickupDate) pickupDate.style.display = 'none';
            if (departureDate) departureDate.parentElement.style.display = 'none';
            arrivalInput.disabled = false;
        } else {
            // Default: sembunyikan port section jika tidak ada kondisi yang cocok
            portSection.style.display = 'none';
        }
    };

    // Jalankan saat halaman dimuat
    togglePortSection();

    // Karena input readonly tidak bisa diubah user, tidak perlu event listener
    // Tapi jika suatu saat diubah jadi select yang bisa diubah, tambahkan ini:
    // transportationInput.addEventListener('change', togglePortSection);
    // shipmentInput.addEventListener('change', togglePortSection);
});
</script>
@endsection
