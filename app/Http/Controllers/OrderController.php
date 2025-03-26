<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\offersModel;
use App\Models\Order;
use App\Models\Service;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        $categories = Category::all();
        return view('pages.customer.orders.index', compact('offer','services','categories'));
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
            'selected_services' => 'nullable',
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
        
            $existingCommodities = $order->commodities ? array_map('trim', explode(', ', $order->commodities)) : [];
            $newCommodities = $attributes['commodities'] ? array_map('trim', explode(', ', $attributes['commodities'])) : [];
        
            $filteredCommodities = array_diff($newCommodities, $existingCommodities);
        
            $updatedCommodities = !empty($filteredCommodities) 
                ? implode(', ', array_merge($existingCommodities, $filteredCommodities)) 
                : $order->commodities;
        
            $order->update([
                "remainingWeight" => max(0, $remainingWeight),
                "remainingVolume" => max(0, $remainingVolume),
                "totalAmount" => $order->totalAmount + $attributes['total_price'],
                "remainingAmount" => $order->remainingAmount + $attributes['total_price'],
                "commodities" => $updatedCommodities,
            ]);
        }
        

        $userOrder = UserOrder::create([
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
            "services" => $attributes['selected_services'] ?? "",
            "payment_token" => Str::uuid(),
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $offer = offersModel::where('noOffer', $attributes['noOffer'])->first();

        $params = array(
            'transaction_details' => array(
                // 'order_id' => rand(),
                'order_id' => $userOrder->id,
                'gross_amount' => $attributes['total_price'],
            ),
            'customer_details' => array(
                'name' => Auth::user()->username,
                'email' => Auth::user()->email,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $userOrder->snap_token = $snapToken;
        $userOrder->save();

        if ($offer) {
            $remainingWeight = $offer->remainingWeight - $attributes['weight'];
            $remainingVolume = $offer->remainingVolume - $attributes['total_cbm'];
            $status = $offer->status; 
            
            if ($attributes['shipmentType'] === "FCL") {
                $status = "Deactive";
            }
        
            if ($remainingWeight <= 0 || $remainingVolume <= 0) {
                $status = "Deactive";
            }
        
            $existingCommodities = array_map('trim', explode(', ', $offer->commodities));
            $newCommodities = array_map('trim', explode(', ', $attributes['commodities']));
            $filteredCommodities = array_diff($newCommodities, $existingCommodities);

            if (!empty($filteredCommodities)) {
                $updatedCommodities = implode(', ', array_merge($existingCommodities, $filteredCommodities));
            } else {
                $updatedCommodities = $offer->commodities;
            }

            $offer->update([
                "remainingWeight" => max(0, $remainingWeight), 
                "remainingVolume" => max(0, $remainingVolume), 
                "commodities" => $updatedCommodities, 
                "price" => $attributes['price'],
                "status" => $status,
            ]);

        }     

        return redirect('/payment/' . $userOrder->id);
    }    
      
}
