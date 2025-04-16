<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RequestRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestRouteController extends Controller
{
    public function index()
    {
        $list_request = RequestRoute::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('pages.customer.request_routes.index',compact('list_request','categories'));
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
            'address' => 'required',
        ]);

        $requestRoute = RequestRoute::create([
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "shippingDate" => $attributes['shippingDate'],
            "shipmentMode" => $attributes['shipmentMode'],
            "shipmentType" => $attributes['shipmentType'],
            "description" => $attributes['description'],
            "weight" => $attributes['weight'],
            "volume" => ($attributes['length']/100) * ($attributes['width']/100) * ($attributes['height']/100),
            "commodities" => $attributes['commodities'],
            "address" => $attributes['address'],
            "status" => "active",
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
