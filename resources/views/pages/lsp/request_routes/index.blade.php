@extends('layouts.app')

@section('content')

<div class="pc-container">
    <div class="pc-content">
        <div class="container">
            <div class="row">
                <!-- Bagian Kiri (List Request Routes) -->
                <div class="col-md-8">
                    <h3>Permintaan Pengiriman Rute Khusus</h3>
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control me-2" placeholder="Asal">
                        <input type="text" class="form-control me-2" placeholder="Tujuan">
                        <button class="btn btn-primary">Cari</button>
                    </div>

                    @foreach ($requests as $request)
                        <div class="card mb-3 p-3 border-primary" style="border-radius: 10px">
                            <div class="d-flex justify-content-between">
                                <h5><i class="bi bi-building"></i> {{ $request->userName }}</h5>
                                <span>ID : {{ $request->id }}</span>
                            </div>
                            <hr style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                            <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi:</strong> {{ $request->shipmentMode }}</p>
                            <p><strong>Asal : </strong> {{ $request->origin }}</p>
                            <p><strong>Tujuan : </strong> {{ $request->destination }}</p>
                            <hr style="border-top: 1px solid #0484C4; margin-left: -16px; margin-right: -16px; width: calc(100% + 32px); opacity:1;">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary lihat-detail"
                                        data-id="{{ $request->id }}"
                                        data-user="{{ $request->userName }}"
                                        data-origin="{{ $request->origin }}"
                                        data-destination="{{ $request->destination }}"
                                        data-mode="{{ $request->shipmentMode }}"
                                        data-date="{{ $request->shippingDate }}"
                                        data-weight="{{ $request->weight }}"
                                        data-volume="{{ $request->volume }}"
                                        data-commodities="{{ $request->commodities }}"
                                        data-status="{{ $request->status }}"
                                        data-description="{{ $request->description}}"
                                        style="border-radius: 10px; width: 250px">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Bagian Kanan (Detail Permintaan) -->
                <div class="col-md-4">
                    <h4>Detail Permintaan</h4>
                    <div id="detail-container" class="card p-3" style="display: none; border: 1px solid; border-color: #0484C4; border-radius: 10px">
                        <h3>Pengaju: <span id="detail-user"></span></h3>
                        <br>
                        <p style="display:flex;justify-content:space-between"><strong>Jenis Transportasi :</strong> <span id="detail-mode"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Lokasi Asal :</strong> <span id="detail-origin"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Lokasi Tujuan :</strong> <span id="detail-destination"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Tanggal Pengiriman :</strong> <span id="detail-date"></span></p>
                        <hr style="border-top: 1px solid #0484C4; opacity:1">
                        <h5 style="margin-bottom: 20px">Detail Muatan</h5>
                        <p style="display:flex;justify-content:space-between"><strong>Berat :</strong> <span id="detail-weight"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Volume :</strong> <span id="detail-volume"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Komoditas :</strong> <span id="detail-commodities"></span></p>
                        <p style="display:flex;justify-content:space-between"><strong>Status :</strong> <span id="detail-status"></span></p>
                        <p style="display:grid"><strong>Deskripsi</strong> <span id="detail-description"></span></p>
                        <div style="display:flex; justify-content:end">
                            <a href="#" class="btn btn-primary mt-5" style="border-radius:10px">Ajukan Penawaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".lihat-detail");
    const detailContainer = document.getElementById("detail-container");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            document.getElementById("detail-user").textContent = this.getAttribute("data-user");
            document.getElementById("detail-mode").textContent = this.getAttribute("data-mode");
            document.getElementById("detail-origin").textContent = this.getAttribute("data-origin");
            document.getElementById("detail-destination").textContent = this.getAttribute("data-destination");
            document.getElementById("detail-date").textContent = this.getAttribute("data-date");
            document.getElementById("detail-weight").textContent = this.getAttribute("data-weight")+" Kg";
            document.getElementById("detail-volume").textContent = this.getAttribute("data-volume")+" CBM";
            document.getElementById("detail-commodities").textContent = this.getAttribute("data-commodities");
            document.getElementById("detail-status").textContent = this.getAttribute("data-status");
            document.getElementById("detail-description").textContent = this.getAttribute("data-description");

            detailContainer.style.display = "block";
        });
    });
});

</script>
@endsection

