<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        return view('pages.customer.payments.index', compact('offer','services'));
    }

    public function order(Request $request)
    {
        $attributes = $request->validate([
            'weight' => 'required',
            'width' => 'required',
            'height' => 'required',
            'length' => 'required',
            'commodities' => 'required',
            'telpNumber' => 'required',
            'description' => 'required',
            'noOffer' => 'required',
            'lspName' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'shipmentMode' => 'required',
            'shipmentType' => 'required',
            'loadingDate' => 'required',
            'estimationDate' => 'required',
            'shippingDate' => 'required',
            'maxWeight' => 'required',
            'maxVolume' => 'required',
            'commodities' => 'required',
            'price' => 'required',
            'total_cbm' => 'required',
            'total_price' => 'required',
            'selected_services' => 'required',
            'remainingWeight' => 'required',
            'remainingVolume' => 'required',
        ]); 

        $requestRoute = Order::create([
            "noOffer" => $attributes['noOffer'],
            "lspName" => $attributes['lspName'],
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "shipmentType" => $attributes['shipmentType'],
            "shipmentMode" => $attributes['shipmentMode'],
            "loadingDate" => $attributes['loadingDate'],
            "estimationDate" => $attributes['estimationDate'],
            "shippingDate" => $attributes['shippingDate'],
            "maxWeight" => $attributes['maxWeight'],
            "maxVolume" => $attributes['maxVolume'],
            "commodities" => $attributes['commodities'],
            "status" => "Menunggu Tanggal Muat",
            "remainingWeight" => $attributes['remainingWeight'] - $attributes['weight'],
            "remainingVolume" => $attributes['remainingVolume'] - $attributes['total_cbm'],
            "price" => $attributes['price'],
            "totalAmount" => $attributes['total_price'],
            "paidAmount" => 0, 
            "remainingAmount" => $attributes['total_price'], 
            "paymentStatus" => "Belum Lunas"
        ]);
        return redirect('/search-routes')->with('success', 'Order Berhasil');

    }
}
