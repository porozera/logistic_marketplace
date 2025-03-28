<?php

namespace App\Http\Controllers;
use App\Models\RequestRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestRouteController extends Controller
{
    public function index()
    {
        $list_request = RequestRoute::where('user_id',Auth::id())->paginate(10);
        return view('pages.customer.request_routes.index',compact('list_request'));
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
            "deadline" => Carbon::now()->addDays(7)->toDateString()
        ]);
        $deadline = Carbon::now()->addDays(7)->toDateString();
        return redirect("/request-routes/success?deadline=$deadline")->with('success', 'Permintaan rute berhasil dikrimkan!');
    }

    public function success()
    {
        return view('pages.customer.request_routes.success');
    }
}
