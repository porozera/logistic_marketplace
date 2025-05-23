<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Container;
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
        $containers = Container::all();
        return view('pages.customer.request_routes.index',compact('list_request','categories','containers'));
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
            'container_id' => 'nullable',
        ]);

        $category = Category::where('name', $attributes['commodities'])->first();
        // dd($attributes['commodities'], $category);
        $cargoType = $category->type ?? null;

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
            "deadline" => Carbon::now()->addDays(7)->toDateString(),
            "cargoType" => $cargoType,
            "container_id" => $attributes['container_id'],
        ]);
        $deadline = Carbon::now()->addDays(7)->toDateString();
        // return redirect("/request-routes/success?deadline=$deadline")->with('success', 'Permintaan rute berhasil dikrimkan!');
        return redirect("/request-routes")->with('success', 'Permintaan rute berhasil dikrimkan! Silakan cek kotak pesan secara berkala');
    }

    public function success()
    {
        return view('pages.customer.request_routes.success');
    }
}
