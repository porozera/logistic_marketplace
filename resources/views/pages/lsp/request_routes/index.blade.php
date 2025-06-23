@extends('layouts.app')

@section('content')
    <style>
        #container-detail {
            position: fixed;
            /* top: 50px; Sesuaikan dengan navbar/header jika ada */
            right: 20px;
            /* Jarak dari kanan */
            width: 29%;
            /* Atur ukuran yang sesuai */
            max-height: 90vh;
            /* Batas tinggi agar tidak melebihi layar */
            overflow-y: auto;
            /* Tambahkan scroll jika kontennya panjang */
            /* background: white; */
            padding: 10px;
            border-radius: 10px;
            z-index: 1000;
        }
    </style>
    <div class="pc-container">
        <div class="pc-content">
            <div class="">
                <div class="row">
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                                        <li class="breadcrumb-item" aria-current="page">Permintaan Pengiriman</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian Kiri (List Request Routes) -->
                    <div class="col-md-8">
                        <h2>Permintaan Pengiriman Rute Khusus</h2>
                        <div class="mb-3 d-flex">
                            <input type="text" class="form-control me-2" placeholder="Asal">
                            <input type="text" class="form-control me-2" placeholder="Tujuan">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @foreach ($requests as $request)
                            <div class="card mb-3 p-3 border-primary" style="border-radius: 10px">
                                <div class="d-flex justify-content-between">
                                    <div style="display: flex; align-items:center">
                                        {{-- {{ asset('storage/' . $user->profilePicture) }} --}}
                                        {{-- @foreach ($user as $user) --}}
                                        {{-- {{dd($request->user->profilePicture);}} --}}
                                        <img src="{{asset('default-profile.jpg')}}"
                                            alt="Profile Picture" class="rounded-circle border border-white"
                                            style="width: 43px; height: 43px; object-fit: cover;">
                                        {{-- @endforeach --}}
                                        <h4 style="margin-left: 10px; text-align:center"><i class="bi bi-building"></i>
                                            {{ $request->userName }}</h4>
                                    </div>
                                    <span>ID : {{ $request->id }}</span>
                                </div>
                                <hr
                                    style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                                <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi:</strong>
                                    {{ $request->shipmentMode }}</p>
                                <p><strong>Asal : </strong> {{ $request->origin }}</p>
                                <p><strong>Tujuan : </strong> {{ $request->destination }}</p>
                                <hr
                                    style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary lihat-detail" data-id="{{ $request->id }}"
                                        data-user="{{ $request->userName }}" data-origin="{{ $request->origin }}"
                                        data-destination="{{ $request->destination }}"
                                        data-mode="{{ $request->shipmentMode }}" data-date="{{ $request->shippingDate }}"
                                        data-weight="{{ $request->weight }}" data-volume="{{ $request->volume }}"
                                        data-commodities="{{ $request->commodities }}"
                                        data-status="{{ $request->status }}"
                                        data-description="{{ $request->description }}"
                                        style="border-radius: 10px; width: 250px">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bagian Kanan (Detail Permintaan) -->
                    <div class="col-md-4" id="container-detail">
                        <h3>Detail Permintaan</h3>
                        <div id="detail-container" class="card p-3"
                            style="display: none; border: 1px solid; border-color: #0484C4; border-radius: 10px">
                            <h3>Pengaju : <span id="detail-user"></span></h3>
                            <br>
                            <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi :</strong>
                                <span id="detail-mode"></span>
                            </p>
                            <p style="display:flex;justify-content:space-between"><strong>Lokasi Asal :</strong> <span
                                    id="detail-origin"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Lokasi Tujuan :</strong> <span
                                    id="detail-destination"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Tanggal Pengiriman :</strong>
                                <span id="detail-date"></span>
                            </p>
                            <hr style="border-top: 1px solid #0484C4; opacity:1">
                            <h5 style="margin-bottom: 20px">Detail Muatan</h5>
                            <p style="display:flex;justify-content:space-between"><strong>Berat :</strong> <span
                                    id="detail-weight"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Volume :</strong> <span
                                    id="detail-volume"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Komoditas :</strong> <span
                                    id="detail-commodities"></span></p>
                            <p style="display:flex;justify-content:space-between"><strong>Status :</strong> <span
                                    id="detail-status"></span></p>
                            <p style="display:grid"><strong>Deskripsi</strong> <span id="detail-description"></span></p>
                            <div style="display:flex; justify-content:end">
                                <a id="btn-ajukan" class="btn btn-primary mt-5" style="border-radius:10px">Ajukan
                                    Penawaran</a>
                                {{-- <a id="btn-ajukan" class="btn btn-primary mt-5" style="border-radius:10px" href="{{ route('bids.create', $request->id) }}">Ajukan Penawaran</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- original --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".lihat-detail");
            const detailContainer = document.getElementById("detail-container");
            const btnAjukan = document.getElementById("btn-ajukan");

            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    let requestId = this.getAttribute("data-id"); // Ambil ID yang sesuai
                    document.getElementById("detail-user").textContent = this.getAttribute(
                        "data-user");
                    document.getElementById("detail-mode").textContent = this.getAttribute(
                        "data-mode");
                    document.getElementById("detail-origin").textContent = this.getAttribute(
                        "data-origin");
                    document.getElementById("detail-destination").textContent = this.getAttribute(
                        "data-destination");
                    document.getElementById("detail-date").textContent = this.getAttribute(
                        "data-date");
                    document.getElementById("detail-weight").textContent = this.getAttribute(
                        "data-weight") + " Kg";
                    document.getElementById("detail-volume").textContent = this.getAttribute(
                        "data-volume") + " CBM";
                    document.getElementById("detail-commodities").textContent = this.getAttribute(
                        "data-commodities");
                    document.getElementById("detail-status").textContent = this.getAttribute(
                        "data-status");
                    document.getElementById("detail-description").textContent = this.getAttribute(
                        "data-description");

                    // Perbarui href tombol "Ajukan Penawaran" agar sesuai dengan request yang dipilih
                    btnAjukan.href = `/bids/create/${requestId}`;

                    detailContainer.style.display = "block";
                });
            });
        });
    </script>

    {{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".lihat-detail");
        const detailContainer = document.getElementById("detail-container");
        const bidFormContainer = document.getElementById("bid-form-container");
        const btnAjukan = document.getElementById("btn-ajukan");
        const bidForm = document.getElementById("bidForm");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                // Tampilkan detail permintaan
                document.getElementById("detail-user").textContent = this.getAttribute("data-user");
                document.getElementById("detail-mode").textContent = this.getAttribute("data-mode");
                document.getElementById("detail-origin").textContent = this.getAttribute("data-origin");
                document.getElementById("detail-destination").textContent = this.getAttribute("data-destination");
                document.getElementById("detail-date").textContent = this.getAttribute("data-date");
                document.getElementById("detail-weight").textContent = this.getAttribute("data-weight") + " Kg";
                document.getElementById("detail-volume").textContent = this.getAttribute("data-volume") + " CBM";
                document.getElementById("detail-commodities").textContent = this.getAttribute("data-commodities");
                document.getElementById("detail-status").textContent = this.getAttribute("data-status");
                document.getElementById("detail-description").textContent = this.getAttribute("data-description");

                // Sembunyikan form penawaran
                bidFormContainer.style.display = "none";

                // Tampilkan container detail
                detailContainer.style.display = "block";

                // Set data untuk form penawaran
                document.getElementById("origin").value = this.getAttribute("data-origin");
                document.getElementById("destination").value = this.getAttribute("data-destination");
                document.getElementById("shipmentMode").value = this.getAttribute("data-mode");
                document.getElementById("shipmentType").value = this.getAttribute("data-shipmentType");
                document.getElementById("shippingDate").value = this.getAttribute("data-date");

                // Set requestOffer_id agar tahu penawaran ini untuk permintaan yang mana
                document.getElementById("requestOffer_id").value = this.getAttribute("data-id");
            });
        });

        // Event listener untuk tombol "Ajukan Penawaran"
        btnAjukan.addEventListener("click", function () {
            bidFormContainer.style.display = "block"; // Tampilkan form penawaran
        });

        // Submit form penawaran dengan AJAX (Opsional, jika ingin tanpa reload)
        bidForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah reload

            let formData = new FormData(bidForm);

            fetch("{{ route('bids.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                alert("Penawaran berhasil diajukan!");
                bidFormContainer.style.display = "none"; // Sembunyikan form setelah sukses
            })
            .catch(error => console.error("Error:", error));
        });
    });
</script> --}}


    {{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".lihat-detail");
        const detailContainer = document.getElementById("detail-container");
        const bidFormContainer = document.getElementById("bid-form-container");
        const btnAjukan = document.getElementById("btn-ajukan");
        const btnKembali = document.getElementById("btn-kembali");
        const bidForm = document.getElementById("bidForm");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                // Tampilkan detail permintaan
                detailContainer.style.display = "block";
                bidFormContainer.style.display = "none"; // Sembunyikan form penawaran

                document.getElementById("detail-user").textContent = this.getAttribute("data-user");
                document.getElementById("detail-mode").textContent = this.getAttribute("data-mode");
                document.getElementById("detail-origin").textContent = this.getAttribute("data-origin");
                document.getElementById("detail-destination").textContent = this.getAttribute("data-destination");
                document.getElementById("detail-date").textContent = this.getAttribute("data-date");
                document.getElementById("detail-weight").textContent = this.getAttribute("data-weight") + " Kg";
                document.getElementById("detail-volume").textContent = this.getAttribute("data-volume") + " CBM";
                document.getElementById("detail-commodities").textContent = this.getAttribute("data-commodities");
                document.getElementById("detail-status").textContent = this.getAttribute("data-status");
                document.getElementById("detail-description").textContent = this.getAttribute("data-description");

                // Set data untuk form penawaran
                document.getElementById("origin").value = this.getAttribute("data-origin");
                document.getElementById("destination").value = this.getAttribute("data-destination");
                document.getElementById("shipmentMode").value = this.getAttribute("data-mode");
                document.getElementById("shipmentType").value = this.getAttribute("data-shipmentType");
                document.getElementById("shippingDate").value = this.getAttribute("data-date");
                document.getElementById("requestOffer_id").value = this.getAttribute("data-id");
            });
        });

        // Event listener untuk tombol "Ajukan Penawaran"
        btnAjukan.addEventListener("click", function () {
            detailContainer.style.display = "none"; // Sembunyikan detail permintaan
            bidFormContainer.style.display = "block"; // Tampilkan form penawaran
        });

        // Event listener untuk tombol "Kembali"
        btnKembali.addEventListener("click", function () {
            detailContainer.style.display = "block"; // Tampilkan detail permintaan
            bidFormContainer.style.display = "none"; // Sembunyikan form penawaran
        });

        // Submit form penawaran dengan AJAX (Opsional, jika ingin tanpa reload)
        bidForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah reload

            let formData = new FormData(bidForm);

            fetch("{{ route('bids.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                alert("Penawaran berhasil diajukan!");
                detailContainer.style.display = "block"; // Kembali ke detail setelah submit
                bidFormContainer.style.display = "none";
            })
            .catch(error => console.error("Error:", error));
        });
    });
</script> --}}
@endsection
