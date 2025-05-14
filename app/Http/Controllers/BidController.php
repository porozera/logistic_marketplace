<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Container;
use App\Models\RequestRoute;
use App\Models\Truck;
use App\Models\Container;
use App\Models\Notification;
use App\Models\Truck;
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
        $trucks = Truck::with('user')
            ->where('user_id', Auth::id())
            ->get();

        $containers = Container::all();
        return view('pages.lsp.request_routes.bid', compact('requestRoute', 'trucks', 'containers'));
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
        'container_id' => 'required|exists:containers,id',
        'truck_first_id' => 'required|exists:trucks,id',
        'truck_second_id' => 'required|exists:trucks,id',
    ]);
    $category = Category::where('name', $request['commodities'])->first();
        // dd($attributes['commodities'], $category);
    $cargoType = $category->type ?? null;
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
        'commodities' => $request->commodities,
        'maxWeight' => $validated['maxWeight'],
        'maxVolume' => $validated['maxVolume'],
        'remainingWeight' => $validated['maxWeight'],
        'remainingVolume' => $validated['maxVolume'],
        'price' => $validated['price'],
        'container_id' => $validated['container_id'],
        'truck_first_id' => $validated['truck_first_id'],
        'truck_second_id' => $validated['truck_second_id'],
        'status' => 'active',
        'lspName' => auth()->user()->companyName,
        'user_id' => auth()->id(),
        'cargoType' => $cargoType,
        'container_id' => $validated['container_id'],
        'truck_first_id' => $validated['truck_first_id'],
        'truck_second_id' => $validated['truck_second_id'],
    ]);


    // Ambil user pembuat permintaan
    $requestRoute = RequestRoute::findOrFail($request->requestOffer_id);
    $requestUser = $requestRoute->user_id; // User ID pembuat permintaan

    // Simpan notifikasi untuk user terkait
    Notification::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $requestUser,
        'header' => 'Penawaran Baru Diterima!',
        'description' => 'LSP ' . auth()->user()->companyName . ' telah mengajukan penawaran untuk permintaan pengiriman Anda.',
    ]);

    return redirect()->route('permintaan.pengiriman')->with('success', 'Penawaran berhasil diajukan!');
    }

    public function index ()
    {
        $bids = Bid::where('user_id', auth()->id())->get();
        return view('pages.lsp.list-bids.index', compact('bids'));
    }
}
