<?php

namespace App\Http\Controllers;
use App\Models\RequestRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestRouteController extends Controller
{
    public function index()
    {
        return view('pages.request_routes.index');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'shippingDate' => 'required',
            'shipmentMode' => 'required',
            'shipmentType' => 'required',
            'description' => 'required',
            'weight' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'commodities' => 'required',
        ]);

        $requestRoute = RequestRoute::create([
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "shippingDate" => $attributes['shippingDate'],
            "shipmentMode" => $attributes['shipmentMode'],
            "shipmentType" => $attributes['shipmentType'],
            "description" => $attributes['description'],
            "weight" => $attributes['weight'],
            "volume" => $attributes['length'] * $attributes['width'] * $attributes['height'],
            "commodities" => $attributes['commodities'],
            "status" => "Open",
            "user_id" => Auth::id(),
            "username" => Auth::user()->username,
        ]);
        return redirect("/customer/request-routes/success")->with('success', 'Permintaan rute berhasil dikrimkan!');
    }

    public function success()
    {
        return view('pages.request_routes.success');
    }
}
