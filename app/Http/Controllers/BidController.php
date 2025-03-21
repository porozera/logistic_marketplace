<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\RequestRoute;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'loadingDate' => 'required|date',
    //         'estimationDate' => 'required|date',
    //         'maxWeight' => 'required|integer',
    //         'maxVolume' => 'required|integer',
    //         'remainingWeight' => 'nullable|integer',
    //         'remainingVolume' => 'nullable|integer',
    //         'status' => 'required|in:active,deactive',
    //         'price' => 'required|numeric',
    //         'requestOffer_id' => 'required|exists:request_routes,id',
    //     ]);

    //     // Ambil data request route berdasarkan requestOffer_id
    //     $requestRoute = RequestRoute::findOrFail($request->requestOffer_id);

    //     // Buat nomor penawaran unik
    //     $noOffer = 'BID' . now()->format('YmdHis') . Auth::id();

    //     // Simpan data bid
    //     $bid = Bid::create([
    //         'noOffer' => $noOffer,
    //         'lspName' => Auth::user()->companyName, // Nama LSP diambil dari user yang login
    //         'origin' => $requestRoute->origin,
    //         'destination' => $requestRoute->destination,
    //         'shipmentMode' => $requestRoute->shipmentMode,
    //         'shipmentType' => $requestRoute->shipmentType,
    //         'loadingDate' => $request->loadingDate,
    //         'shippingDate' => $requestRoute->shippingDate,
    //         'estimationDate' => $request->estimationDate,
    //         'maxWeight' => $request->maxWeight,
    //         'maxVolume' => $request->maxVolume,
    //         'remainingWeight' => $request->remainingWeight,
    //         'remainingVolume' => $request->remainingVolume,
    //         'status' => $request->status,
    //         'price' => $request->price,
    //         'size' => 0, // Bisa ditentukan nanti
    //         'user_id' => Auth::id(),
    //         'requestOffer_id' => $request->requestOffer_id,
    //     ]);

    //     return response()->json(['message' => 'Penawaran berhasil diajukan', 'bid' => $bid]);
    // }
    public function create($id)
    {
        $requestRoute = RequestRoute::findOrFail($id);
        return view('pages.lsp.request_routes.bid', compact('requestRoute'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'requestOffer_id' => 'required|exists:request_routes,id',
        'loadingDate' => 'required|date',
        'estimationDate' => 'required|date',
        'maxWeight' => 'required|integer',
        'maxVolume' => 'required|integer',
        'price' => 'required|numeric',
    ]);

    Bid::create([
        'noOffer' => 'BID-' . strtoupper(uniqid()), // Pastikan 'noOffer' memiliki nilai unik
        'requestOffer_id' => $validated['requestOffer_id'],
        'origin' => $request->origin,
        'destination' => $request->destination,
        'shipmentMode' => $request->shipmentMode,
        'shipmentType' => $request->shipmentType,
        'shippingDate' => $request->shippingDate,
        'loadingDate' => $validated['loadingDate'],
        'estimationDate' => $validated['estimationDate'],
        'maxWeight' => $validated['maxWeight'],
        'maxVolume' => $validated['maxVolume'],
        'remainingWeight' => $validated['maxWeight'],
        'remainingVolume' => $validated['maxVolume'],
        'price' => $validated['price'],
        'status' => 'active',
        'lspName' => auth()->user()->companyName,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('permintaan.pengiriman')->with('success', 'Penawaran berhasil diajukan!');
}

}
