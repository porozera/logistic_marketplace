<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;
use App\Models\Order;

class OpenContainerController extends Controller
{
    public function index(Request $request)
{
    $searchPerformed = false;
    $offers = collect([]); // Default: Kosong saat pertama kali dibuka

    if ($request->has('origin') || $request->has('destination') || $request->has('shippingDate') || $request->has('shipmentMode')) {
        $searchPerformed = true;

        $query = offersModel::query()
            ->where('is_for_lsp', true)
            ->where('shipmentType', 'LCL')
            ->where('status', 'active');

        if ($request->filled('origin')) {
            $query->where('origin', 'LIKE', '%' . $request->origin . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
        }

        if ($request->filled('shippingDate')) {
            $query->whereDate('shippingDate', $request->shippingDate);
        }

        if ($request->filled('shipmentMode')) {
            $query->where('shipmentMode', $request->shipmentMode);
        }

        $offers = $query->with('user:id,username,profilePicture,rating')->get();
    }

    return view('pages.lsp.opencontainer.index', compact('offers', 'searchPerformed'));
}

public function ajukanPenawaran($id)
{
    $offer = offersModel::findOrFail($id);
    return view('pages.lsp.opencontainer.ajukan', compact('offer'));
}

public function storePenawaran(Request $request, $id)
{
    $offer = OffersModel::findOrFail($id);

    // Validasi data kalau perlu
    $request->validate([
        'telp' => 'required',
        'itemType' => 'required',
        'paymentMethod' => 'required',
    ]);

    Order::create([
        'noOffer' => $offer->noOffer,
        'lspName' => $offer->lspName,
        'origin' => $offer->origin,
        'destination' => $offer->destination,
        'shipmentMode' => $offer->shipmentMode,
        'shipmentType' => $offer->shipmentType,
        'loadingDate' => $offer->loadingDate,
        'shippingDate' => $offer->shippingDate,
        'estimationDate' => $offer->estimationDate,
        'maxWeight' => $offer->maxWeight,
        'maxVolume' => $offer->maxVolume,
        'remainingWeight' => $offer->remainingWeight,
        'remainingVolume' => $offer->remainingVolume,
        'commodities' => $request->description,
        'status' => 'waiting',
        'price' => $offer->price,
        'totalAmount' => $offer->price,
        'remainingAmount' => $offer->price,
        'paidAmount' => 0,
        'paymentStatus' => $request->paymentMethod,
        'container_id' => $offer->container_id,
        'truck_first_id' => $offer->truck_first_id,
        'truck_second_id' => $offer->truck_second_id,
        'address' => null,
        'timestamp' => now(),
    ]);

    return redirect()->route('opencontainer.index')->with('success', 'Penawaran berhasil diajukan.');
}
}
