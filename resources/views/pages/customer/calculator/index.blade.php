@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Load Calculator')
@section('styles')
<style>
.badge-status {
    min-width: 100px;
    display: inline-block;
    text-align: center;
}
</style>
@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Load Calculator</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h4>Load Calculator</h4>
        </div>
        <div class="row ">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-10">Pilih Kontainer</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" name="container" id="containerSelect">
                                            @foreach ($containers as $container)
                                                <option 
                                                    value="{{ $container->name }}"
                                                    data-weight="{{ $container->weight }}"
                                                    data-volume="{{ $container->volume }}"
                                                >
                                                    {{ $container->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group mb-3">
                                            <input type="number" id="containerQty" class="form-control">
                                            <span class="input-group-text">qty</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group mb-3">
                                            <input type="number" id="containerWeight" class="form-control" readonly>
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-group mb-3">
                                            <input type="number" id="containerVolume" class="form-control" readonly>
                                            <span class="input-group-text">CBM</span>
                                        </div>
                                    </div>
                                </div>
                        <h5 class="m-b-10 mt-4">Data Muatan</h5>
                        <div id="itemsContainer">
                            @php
                                $oldItems = old('items', [ [] ]);
                            @endphp
                            @foreach ($oldItems as $i => $item)
                            <div class="item-row border p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-11">
                                        <select class="form-control" name="items[{{ $i }}][commodities]">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->name}}" {{ (old("items.$i.commodities", $item['commodities'] ?? '') == $category->name) ? 'selected' : '' }}>
                                                    {{$category->code}} - {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-icon btn-light-danger remove-item"><i class="ti ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row mt-2">
                                        
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][length]" class="form-control length" placeholder="Panjang" value="{{ old("items.$i.length", $item['length'] ?? '') }}">
                                            <span class="input-group-text"><i class="ti ti-x"></i></span>
                                            <input type="number" name="items[{{ $i }}][width]" class="form-control width" placeholder="Lebar" value="{{ old("items.$i.width", $item['width'] ?? '') }}">
                                            <span class="input-group-text"><i class="ti ti-x"></i></span>
                                            <input type="number" name="items[{{ $i }}][height]" class="form-control height" placeholder="Tinggi" value="{{ old("items.$i.height", $item['height'] ?? '') }}">
                                            <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][weight]" class="form-control weight" placeholder="Berat" value="{{ old("items.$i.weight", $item['weight'] ?? '') }}">
                                            <span class="input-group-text"> kg</span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group mb-3">
                                            <input type="number" name="items[{{ $i }}][qty]" class="form-control qty" placeholder="Qty" value="1{{ old("items.$i.qty", $item['qty'] ?? '') }}">
                                            <span class="input-group-text"> qty</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <div class="col-3 d-flex align-items-end ms-auto">
                                            <div class="input-group mb-3">
                                                <input type="number" name="items[{{ $i }}][volume]" class="form-control volume" value="{{ old("items.$i.volume", $item['volume'] ?? '') }}" readonly>
                                                <span class="input-group-text"> CBM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-2">
                                    
                                    {{-- <button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-end mb-3">
                            <button type="button" id="addItemBtn" class="btn btn-primary">+ Tambah Barang</button>
                        </div>                                
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Hasil Perhitungan</h5>
                    </div>
                    <div class="card-body">
                        <p class="">Total Volume Muatan: <span id="cbmResult" class="text-danger fw-bold">0</span> CBM</p>
                        <hr>
                        <p class="">Total Berat Muatan: <span id="totalWeight" class="text-danger fw-bold">0</span> kg</p>
                        <hr>
                        <p class="">CBM yang Harus Dibeli: <span id="cbmToBuy" class="text-danger fw-bold">0</span> CBM</p>
                        <hr>
                        <p>Volume muatan <span id="volumePercent" class="text-danger fw-bold">0</span>% dari maksimal</p>
                        <hr>
                        <p>Berat muatan <span id="weightPercent" class="text-danger fw-bold">0</span>% dari maksimal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script>
          let itemIndex = 1;

          document.getElementById('addItemBtn').addEventListener('click', function () {
            const container = document.getElementById('itemsContainer');
            const newItem = document.querySelector('.item-row').cloneNode(true);

            const itemIndex = container.querySelectorAll('.item-row').length;

            newItem.querySelectorAll('input, select').forEach((input) => {
              const name = input.getAttribute('name');
              const newName = name.replace(/\[\d+\]/, `[${itemIndex}]`);
              input.setAttribute('name', newName);
              if (input.tagName === "SELECT") {
                input.selectedIndex = 0;
              } else {
                input.value = '';
              }
            });

            container.appendChild(newItem);
            registerCBMListeners();
            calculateCBM();
          });

          document.getElementById('itemsContainer').addEventListener('click', function (e) {
            const removeBtn = e.target.closest('.remove-item');
            if (removeBtn) {
              const rows = document.querySelectorAll('.item-row');
              if (rows.length > 1) {
                removeBtn.closest('.item-row').remove();
                calculateCBM(); 
              } else {
                alert("Minimal harus ada satu item.");
              }
            }
          });
        </script>
        <script>
          function registerCBMListeners() {
            document.querySelectorAll(".item-row input").forEach(input => {
                input.removeEventListener("input", calculateCBM);
                input.addEventListener("input", calculateCBM);
            });

            document.querySelectorAll('.item-row select').forEach(select => {
                select.removeEventListener("change", calculateCBM);
                select.addEventListener("change", calculateCBM);
            });
            }     
            document.getElementById('submitFormButton').addEventListener('click', function () {
                document.getElementById('orderForm').submit();
            });

        function calculateCBM() {
            const containerSelect = document.getElementById('containerSelect');
            const containerQtyInput = document.getElementById('containerQty');
            const selectedOption = containerSelect.options[containerSelect.selectedIndex];
            const maxVolume = parseFloat(selectedOption.getAttribute('data-volume')) || 1;
            const maxWeight = parseFloat(selectedOption.getAttribute('data-weight')) || 1;
            const containerQty = parseInt(containerQtyInput.value) || 1;
            const maxWeightPerCBM = 600;

            let totalCBM = 0;
            let totalWeight = 0;
            let totalCBMByWeight = 0;

            const items = document.querySelectorAll(".item-row");
            items.forEach((item) => {
                let length = parseFloat(item.querySelector(".length")?.value) || 0;
                let width = parseFloat(item.querySelector(".width")?.value) || 0;
                let height = parseFloat(item.querySelector(".height")?.value) || 0;
                let weight = parseFloat(item.querySelector(".weight")?.value) || 0;
                let qty = parseFloat(item.querySelector(".qty")?.value) || 0;

                let lengthM = length / 100;
                let widthM = width / 100;
                let heightM = height / 100;

                let cbm = lengthM * widthM * heightM * qty;
                let cbmByWeight = (weight * qty) / maxWeightPerCBM;
                let cbmRounded = Math.round(cbm * 1000) / 1000;

                totalCBM += cbm;
                totalCBMByWeight += cbmByWeight;
                totalWeight += weight * qty;

                let volumeInput = item.querySelector('.volume');
                if (volumeInput) volumeInput.value = cbmRounded;
            });

            let cbmRoundedTotal = Math.round(totalCBM * 1000) / 1000;
            let cbmToBuy = Math.max(Math.ceil(cbmRoundedTotal), Math.ceil(totalCBMByWeight));

            document.getElementById("cbmResult").innerText = cbmRoundedTotal.toFixed(3);
            document.getElementById("cbmToBuy").innerText = cbmToBuy;
            document.getElementById("totalWeight").innerText = totalWeight.toFixed(1);

            let maxTotalVolume = maxVolume * containerQty;
            let maxTotalWeight = maxWeight * containerQty;
            let volumePercent = maxTotalVolume > 0 ? ((cbmToBuy / maxTotalVolume) * 100).toFixed(1) : 0;
            let weightPercent = maxTotalWeight > 0 ? ((totalWeight / maxTotalWeight) * 100).toFixed(1) : 0;

            document.getElementById("volumePercent").innerText = volumePercent;
            document.getElementById("weightPercent").innerText = weightPercent;
        }
        </script>
        <script>
            const containerSelect = document.getElementById('containerSelect');
            const containerQtyInput = document.getElementById('containerQty');
            const containerWeight = document.getElementById('containerWeight');
            const containerVolume = document.getElementById('containerVolume');

            function updateContainerResult() {
                const selectedOption = containerSelect.options[containerSelect.selectedIndex];
                const weight = parseFloat(selectedOption.getAttribute('data-weight')) || 0;
                const volume = parseFloat(selectedOption.getAttribute('data-volume')) || 0;
                const qty = parseInt(containerQtyInput.value) || 0;

                containerWeight.value = weight * qty;
                containerVolume.value = volume * qty;
            }

            containerSelect.addEventListener('change', updateContainerResult);
            containerQtyInput.addEventListener('input', updateContainerResult);

            window.addEventListener('DOMContentLoaded', function () {
                containerQtyInput.value = 1;
                updateContainerResult();
            });
            window.addEventListener('DOMContentLoaded', function () {
                const select = document.getElementById('containerSelect');
                const selectedOption = select.options[select.selectedIndex];
                document.getElementById('containerWeight').value = selectedOption.getAttribute('data-weight');
                document.getElementById('containerVolume').value = selectedOption.getAttribute('data-volume');
            });
        </script>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            registerCBMListeners();
            calculateCBM();
          });
        </script>
@endsection


