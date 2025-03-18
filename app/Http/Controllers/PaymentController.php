<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Order;
use App\Models\Service;
use App\Models\UserOrder;
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
            'price' => 'required',
            'total_cbm' => 'required',
            'total_price' => 'required',
            'selected_services' => 'required',
            'remainingWeight' => 'required',
            'remainingVolume' => 'required',
            'user_id' => 'required',
            'is_for_customer' => 'required',
            'is_for_lsp' => 'required',
            'status' => 'required',
        ]);

        $order = Order::where('noOffer', $attributes['noOffer'])->first();

        if (!$order) {
            $order = Order::create([
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
        } else {
            $remainingWeight = $order->remainingWeight - $attributes['weight'];
            $remainingVolume = $order->remainingVolume - $attributes['total_cbm'];

            $order->update([
                "remainingWeight" => $remainingWeight,
                "remainingVolume" => $remainingVolume,
                "totalAmount" => $order->totalAmount + $attributes['total_price'],
                "remainingAmount" => $order->remainingAmount + $attributes['total_price'],
                "commodities" => $order->commodities . ", " . $attributes['commodities'], // Gabungkan commodities
            ]);
        }

        UserOrder::create([
            "user_id" => Auth::id(),
            "order_id" => $order->id,
            "username" => Auth::user()->username,
            "telpNumber" => $attributes['telpNumber'],
            "description" => $attributes['description'],
            "totalPrice" => $attributes['total_price'],
            "paymentStatus" => "Belum Lunas",
            "weight" => $attributes['weight'],
            "volume" => $attributes['total_cbm'],
            "commodities" => $attributes['commodities'],
            "services" => $attributes['selected_services'],
        ]);

        $offer = offersModel::where('noOffer', $attributes['noOffer'])->first();

        if ($offer) {
            $remainingWeight = $offer->remainingWeight - $attributes['weight'];
            $remainingVolume = $offer->remainingVolume - $attributes['total_cbm'];

            $status = ($attributes['shipmentType'] === "FCL" || $remainingWeight <= 0 || $remainingVolume <= 0) ? "Deactive" : $offer->status;

            $offer->update([
                "remainingWeight" => max(0, $remainingWeight), 
                "remainingVolume" => max(0, $remainingVolume), 
                "commodities" => trim($offer->commodities . ", " . $attributes['commodities'], ", "), 
                "price" => $attributes['price'],
                "status" => $status,
            ]);
        }

        

        return redirect('/search-routes')->with('success', 'Order Berhasil');
    }


}
