@extends('layouts.app')

@section('title', 'Edit Rute')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Detail Offer</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="noOffer" class="form-label">No Offer</label>
                            <input type="text" class="form-control" id="noOffer" name="noOffer"
                                value="{{ $offer->noOffer }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control" id="origin" name="origin"
                                value="{{ $offer->origin }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination"
                                value="{{ $offer->destination }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="container">Pilih Jenis Container</label>
                            <select name="container_id" class="form-control" id="container_id" required>
                                <option disabled selected>-- Pilih --</option>
                                @foreach ($containers as $container)
                                    <option value="{{ $container->id }}"
                                        data-weight="{{ $container->weight }}"
                                        data-volume="{{ $container->volume }}"
                                        {{ $offer->container_id == $container->id ? 'selected' : '' }}>
                                        {{ $container->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Preview Container Info --}}
                        <div id="container-info" class="mt-3" style="{{ $offer->container_id ? '' : 'display:none;' }}">
                            <p><strong>Berat Maksimal:</strong> <span id="weight-preview">{{ $offer->container->weight ?? '' }}</span> Kg</p>
                            <p><strong>Volume Maksimal:</strong> <span id="volume-preview">{{ $offer->container->volume ?? '' }}</span> CBM</p>
                        </div>


                        <div class="mb-3">
                            <label for="commodities" class="form-label">Commodities</label>
                            {{-- <input type="text" class="form-control" id="commodities" name="commodities"
                                value="{{ $offer->commodities }}" required> --}}
                                <select class="form-select" name="commodities" id="commodities">
                                    @foreach ($commodities as $commodities)
                                        <option value="{{ $commodities->name }}"
                                            {{ $offer->commodities == $commodities->name ? 'selected' : '' }}>
                                            {{ $commodities->name }}
                                        </option>

                                    @endforeach
                                </select>
                        </div>

                        <div class="mb-3">
                            <label for="shipmentMode" class="form-label">Shipment Mode</label>
                            <select class="form-select" id="shipmentMode" name="shipmentMode" required>
                                <option value="D2D" {{ $offer->shipmentMode == 'D2D' ? 'selected' : '' }}>D2D</option>
                                <option value="D2P" {{ $offer->shipmentMode == 'D2P' ? 'selected' : '' }}>D2P</option>
                                <option value="P2D" {{ $offer->shipmentMode == 'P2D' ? 'selected' : '' }}>P2D</option>
                                <option value="P2P" {{ $offer->shipmentMode == 'P2P' ? 'selected' : '' }}>P2P</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shipmentType" class="form-label">Shipment Type</label>
                            <select class="form-select" id="shipmentType" name="shipmentType" required>
                                <option value="FCL" {{ $offer->shipmentType == 'FCL' ? 'selected' : '' }}>FCL</option>
                                <option value="LCL" {{ $offer->shipmentType == 'LCL' ? 'selected' : '' }}>LCL</option>
                            </select>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="maxWeight" class="form-label">Max Weight</label>
                            <input type="number" class="form-control" id="maxWeight" name="maxWeight"
                                value="{{ $offer->maxWeight }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="maxVolume" class="form-label">Max Volume</label>
                            <input type="number" class="form-control" id="maxVolume" name="maxVolume"
                                value="{{ $offer->maxVolume }}" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            {{-- <input type="text" class="form-control" id="price" name="price"
                                value="{{ $offer->price }}" required> --}}
                            <input type="text" class="form-control" id="price_display" value="{{ number_format((float) $offer->price, 0, ',', '.') }}">
                            <input type="hidden" name="price" id="price" value="{{ $offer->price }}">
                        </div>

                        <div class="mb-3">
                            <label for="truck_first_id" class="form-label">First Truck</label>
                            <select class="form-select" name="truck_first_id" id="truck_first_id" required>
                                @foreach ($trucks as $truck)
                                    <option value="{{ $truck->id }}"
                                        {{ $offer->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->type }} -
                                        {{ $truck->brand }} - {{ $truck->plateNumber }} ({{ $truck->driverName }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="truck_second_id" class="form-label">Second Truck</label>
                            <select class="form-select" name="truck_second_id" id="truck_second_id" required>
                                @foreach ($trucks as $truck)
                                    <option value="{{ $truck->id }}"
                                        {{ $offer->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->type }} -
                                        {{ $truck->brand }} - {{ $truck->plateNumber }} ({{ $truck->driverName }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ $offer->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="deactive" {{ $offer->status == 'deactive' ? 'selected' : '' }}>Deactive
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Offer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('container').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const weight = selectedOption.getAttribute('data-weight');
            const volume = selectedOption.getAttribute('data-volume');

            document.getElementById('weight-preview').textContent = weight;
            document.getElementById('volume-preview').textContent = volume;

            document.getElementById('container-info').style.display = 'block';
        });
    </script>

    <script>
        // Format angka pada saat pertama kali tampil (edit form)
        window.addEventListener("DOMContentLoaded", () => {
            let display = document.getElementById("price_display");
            let value = document.getElementById("price").value;
            display.value = formatRupiah(value);
        });

        document.getElementById("price_display").addEventListener("input", function(e) {
            let input = this.value.replace(/\D/g, ''); // hanya angka
            this.value = formatRupiah(input);
            document.getElementById("price").value = input;
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
