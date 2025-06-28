<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Container;
use App\Models\RequestItem;
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
            'RTL_start_date' => 'required',
            'RTL_end_date' => 'required',
            'arrivalDate' => 'required',
            'shipmentMode' => 'required',
            'shipmentType' => 'required',
            'transportationMode' => 'required',
            'description' => 'required',
            'items' => 'required|array|min:1',
            'items.*.weight' => 'required|numeric|min:0',
            'items.*.width' => 'required|numeric|min:0',
            'items.*.height' => 'required|numeric|min:0',
            'items.*.length' => 'required|numeric|min:0',
            'items.*.volume' => 'required|numeric|min:0',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.commodities' => 'required|string|max:255',
            'container_id' => 'nullable',
        ]);

        $category = Category::where('name', $attributes['items'][0]['commodities'])->first();
        $cargoType = $category->type ?? null;

        $requestRoute = RequestRoute::create([
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "RTL_start_date" => $attributes['RTL_start_date'],
            "RTL_end_date" => $attributes['RTL_end_date'],
            "arrivalDate" => $attributes['arrivalDate'],
            "transportationMode" => $attributes['transportationMode'],
            "shipmentMode" => $attributes['shipmentMode'],
            "shipmentType" => $attributes['shipmentType'],
            "description" => $attributes['description'],
            "status" => "active",
            "user_id" => Auth::id(),
            "username" => Auth::user()->username,
            "deadline" => Carbon::now()->addDays(7)->toDateString(),
            "cargoType" => $cargoType,
            "container_id" => $attributes['container_id']??null,
        ]);
        $items = $request->input('items', []);
        foreach ($items as $item) {
            RequestItem::create([
                "requestOffer_id" => $requestRoute->id,
                "weight" => $item['weight'],
                "width" => $item['width'] ?? 1,
                "height" => $item['height'] ?? 1,
                "length" => $item['length'] ?? 1,
                "volume" => $item['volume'],
                "qty" => $item['qty'],
                "commodities" => $item['commodities'],
            ]);  
        }
        return redirect("/request-routes")->with('success', 'Permintaan rute berhasil dikrimkan! Silakan cek kotak pesan secara berkala');
    }

    public function success()
    {
        return view('pages.customer.request_routes.success');
    }
}
