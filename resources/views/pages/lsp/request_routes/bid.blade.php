@extends('layouts.app')

@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="container" style="background-color: white; border-radius:10px; padding:50px">
            <a href="/permintaan-pengiriman">Kembali</a>
            <h2>Ajukan Penawaran</h2>
            <form action="{{ route('bids.store') }}" method="POST">
                @csrf
                <input type="hidden" name="requestOffer_id" value="{{ $requestRoute->id }}">
                <div class="mb-3">
                    <label for="origin" class="form-label">Origin</label>
                    <input type="text" class="form-control" name="origin" value="{{ $requestRoute->origin }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Destination</label>
                    <input type="text" class="form-control" name="destination" value="{{ $requestRoute->destination }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shipmentMode" class="form-label">Shipment Mode</label>
                    <input type="text" class="form-control" name="shipmentMode" value="{{ $requestRoute->shipmentMode }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shipmentType" class="form-label">Shipment Type</label>
                    <input type="text" class="form-control" name="shipmentType" value="{{ $requestRoute->shipmentType }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="shippingDate" class="form-label">Shipping Date</label>
                    <input type="date" class="form-control" name="shippingDate" value="{{ $requestRoute->shippingDate }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="commodities" class="form-label">Commodities</label>
                    <input type="text" class="form-control" name="commodities" value="{{ $requestRoute->commodities }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="loadingDate" class="form-label">Loading Date</label>
                    <input type="date" class="form-control" name="loadingDate" required>
                </div>
                <div class="mb-3">
                    <label for="estimationDate" class="form-label">Estimation Date</label>
                    <input type="date" class="form-control" name="estimationDate" required>
                </div>
                {{-- <div class="mb-3">
                    <label for="maxWeight" class="form-label">Max Weight (Kg)</label>
                    <input type="number" class="form-control" name="maxWeight" required>
                </div>
                <div class="mb-3">
                    <label for="maxVolume" class="form-label">Max Volume (CBM)</label>
                    <input type="number" class="form-control" name="maxVolume" required>
                </div> --}}

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

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
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

                <button type="submit" class="btn btn-primary">Ajukan Penawaran</button>
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

@endsection
