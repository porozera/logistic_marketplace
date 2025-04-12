<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Category;
use App\Models\offersModel;
use App\Models\Order;
use App\Models\RequestRoute;
use App\Models\Service;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class DaftarPenawaranController extends Controller
{
    public function index()
    {
        $query = Bid::where('status', "active");
        $bids = $query->get();
        return view('pages.customer.daftar_penawaran.index',compact('bids'));
    }

    public function detail($id)
    {
        $offer = Bid::find($id);
        $services = Service::all();
        $order = null;
        if ($offer && isset($offer->noOffer)) { 
            $order = Order::where('noOffer', $offer->noOffer)->first() ?? null;
        }
        return view('pages.customer.daftar_penawaran.detail', compact('offer','services','order'));
    }

    public function order_form($id)
    {
        $offer = Bid::find($id);
        $services = Service::all();
        $categories = Category::all();
        return view('pages.customer.daftar_penawaran.order', compact('offer','services','categories'));
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
            'lsp_id' => 'required',
            'address' => 'required',
        ]);

        if ($attributes['total_cbm'] > $attributes['remainingVolume']) {
            throw ValidationException::withMessages([
                'total_cbm' => 'Total CBM yang harus dibeli melebihi sisa volume yang tersedia.',
            ]);
        }
        
        if ($attributes['weight'] > $attributes['remainingWeight']) {
            throw ValidationException::withMessages([
                'weight' => 'Berat melebihi sisa berat yang tersedia.',
            ]);
        }
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
                "address" => $attributes['address'],
                "lsp_id" => $attributes['lsp_id'],
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

        $params = array(
            'transaction_details' => array(
                // 'order_id' => rand(),
                'order_id' => $userOrder->id. '-' . time(),
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

        if($attributes['shipmentType']=="LCL"){
            $status = 'active';
        } else {
            $status = 'deactive';
        }

        $user_id = Bid::where('noOffer', $attributes['noOffer'])->first()->user_id;
        $offer = offersModel::create([
            "noOffer" => $attributes['noOffer'],
            "lspName" => $attributes['lspName'],
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "shipmentMode" => $attributes['shipmentMode'],
            "shipmentType" => $attributes['shipmentType'],
            "loadingDate" => $attributes['loadingDate'],
            "shippingDate" => $attributes['shippingDate'],
            "estimationDate" => $attributes['estimationDate'],
            "maxWeight" => $attributes['maxWeight'],
            "maxVolume" => $attributes['maxVolume'],
            "remainingWeight" => $attributes['maxWeight'] - $attributes['weight'],
            "remainingVolume" => $attributes['maxVolume'] - $attributes['total_cbm'],
            "commodities" => $attributes['commodities'],
            "status" => $status,
            "price" => $attributes['price'],
            "user_id" => $user_id,
            "is_for_lsp" => $attributes['is_for_lsp'],
            "is_for_customer" => $attributes['is_for_customer'],
            "timestamp" => now(),
        ]);

        $bid = Bid::where('noOffer', $attributes['noOffer'])->first();
        $bid->update([
            "status" => 'deactive',
        ]);  

        $requestOffer = RequestRoute::where('id',$bid->requestOffer_id)->first();
        $requestOffer->update([
            "status" => "deactive"
        ]);

        return redirect('/payment/' . $userOrder->payment_token);
    }    
}
