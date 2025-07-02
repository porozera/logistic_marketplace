<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Container;
use App\Models\RequestRoute;
use App\Models\Notification;
use App\Models\Truck;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        return view('pages.lsp.request_routes.bid', compact('requestRoute', 'trucks', 'containers'), ['requestOffer_id' => $id]);
    }

    public function store(Request $request)
{
    // dd($request->all());
    $attributes = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'shipmentMode' => 'required|in:D2D,D2P,P2D,P2P',
            'shipmentType' => 'required|in:FCL,LCL',
            'maxWeight' => 'required|integer',
            'maxVolume' => 'required|integer',
            'status' => 'required|in:active,deactive',
            'price' => 'required|numeric',
            'remainingWeight' => 'nullable|integer',
            'remainingVolume' => 'nullable|integer',
            'container_id' => 'required|exists:containers,id',
            'truck_first_id' => 'required|exists:trucks,id',
            'truck_second_id' => 'required|exists:trucks,id',
            'portOrigin' => 'nullable|string',
            'portDestination' => 'nullable|string',
            'transportationMode' => 'required|in:darat,laut',
            'pickupDate' => 'nullable|date',
            'cyClosingDate' => 'nullable|date',
            'etd' => 'nullable|date',
            'eta' => 'nullable|date',
            'arrivalDate' => 'nullable|date',
            'deliveryDate' => 'nullable|date',
            'departureDate' => 'nullable|date',
            'cargoType' => 'required|string',
    ]);
    // $category = Category::where('name', $request['cargoType'])->first();
    //     // dd($attributes['commodities'], $category);
    // $cargoType = $category->type ?? null;
    $noOffer = 'BID-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

    if (empty($attributes['etd']) &&
            $attributes['transportationMode'] === 'darat' &&
            $attributes['shipmentMode'] === 'D2D') {
            $attributes['etd'] = $attributes['departureDate'];
        }
    if (empty($attributes['eta']) &&
            $attributes['transportationMode'] === 'darat' &&
            $attributes['shipmentMode'] === 'D2D') {
            $attributes['eta'] = $attributes['arrivalDate'];
        }
    Bid::create([
            // 'noOffer' => $attributes['noOffer'],
            'requestOffer_id' => $request->requestOffer_id,
            'noOffer' => $noOffer,
            'lspName' => Auth::user()->username,
            'origin' => $attributes['origin'],
            'destination' => $attributes['destination'],
            'shipmentMode' => $attributes['shipmentMode'],
            'shipmentType' => $attributes['shipmentType'],
            // 'loadingDate' => $attributes['loadingDate'],
            // 'shippingDate' => $attributes['shippingDate'],
            // 'estimationDate' => $attributes['estimationDate'],
            'maxWeight' => $attributes['maxWeight'],
            'maxVolume' => $attributes['maxVolume'],
            'remainingWeight' => $attributes['remainingWeight'],
            'remainingVolume' => $attributes['remainingVolume'],
            // 'commodities' => $attributes['commodities'],
            'status' => $attributes['status'],
            'price' => $attributes['price'],
            'user_id' =>Auth::id(),
            // 'truck_id' => $attributes['truck_id'],
            'container_id' => $attributes['container_id'],
            'truck_first_id' => $attributes['truck_first_id'],
            'truck_second_id' => $attributes['truck_second_id'],
            'is_for_customer' => 1,
            'is_for_lsp' => $attributes['shipmentType'] === 'LCL' ? 1 : 0,
            'timestamp' => now(),
            'cargoType' => $attributes['cargoType'],
            'portOrigin'=> $attributes['portOrigin'],
            'portDestination'=> $attributes['portDestination'],
            'transportationMode'=> $attributes['transportationMode'],
            'pickupDate'=> $attributes['pickupDate'],
            'cyClosingDate'=> $attributes['cyClosingDate'],
            'etd'=> $attributes['etd'],
            'eta'=> $attributes['eta'],
            'arrivalDate'=> $attributes['arrivalDate'],
            'deliveryDate'=> $attributes['deliveryDate'],
            'departureDate'=> $attributes['departureDate'],
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
