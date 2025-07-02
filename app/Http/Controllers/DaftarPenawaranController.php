<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Container;
use App\Models\offersModel;
use App\Models\Order;
use App\Models\RequestRoute;
use App\Models\Service;
use App\Models\ServiceOrdered;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class DaftarPenawaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Bid::where('status', "active");
        $searchPerformed = false;
        if ($request->has('btn_radio1')) {
            if ($request->btn_radio1 == 'Murah') {
                $query->selectRaw('*, CASE 
                    WHEN shipmentType = "FCL" THEN price * maxVolume
                    ELSE price
                END as total_price');
                $query->orderBy('total_price', 'asc');
            } elseif ($request->btn_radio1 == 'Cepat') {
                $query->orderByRaw("DATEDIFF(estimationDate, shippingDate) asc");
            }
            $searchPerformed = true;
        }
        if ($request->has('maxPrice') && $request->maxPrice != '') {
            $query->whereRaw('
                (CASE 
                    WHEN shipmentType = "FCL" THEN price * maxVolume
                    ELSE price
                END) <= ?', [$request->maxPrice]);
            $searchPerformed = true;
        }
        if ($request->has('maxTime') && $request->maxTime != '') {
            $query->whereRaw("
                DATEDIFF(
                    COALESCE(arrivalDate, eta),
                    COALESCE(pickupDate, departureDate, etd)
                ) <= ?
            ", [$request->maxTime]);
            $searchPerformed = true;
        }
        $offers = $query->orderBy('created_at', 'desc')->get();
        $services = Service::all();
        $categories = Category::distinct('type')->pluck('type')->toArray();
        $containers = Container::all();
        return view('pages.customer.daftar_penawaran.index',compact('offers', 'services', 'categories', 'containers','searchPerformed'));
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
        $categories = Category::where('type', $offer->cargoType)->get();
        return view('pages.customer.daftar_penawaran.order', compact('offer','services','categories'));
    }

    public function order(Request $request)
    {
        $attributes = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.weight' => 'required|numeric|min:0',
            'items.*.width' => 'required|numeric|min:0',
            'items.*.height' => 'required|numeric|min:0',
            'items.*.length' => 'required|numeric|min:0',
            'items.*.volume' => 'required|numeric|min:0',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.commodities' => 'required|string|max:255',
            'description' => 'required',
            'noOffer' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'portOrigin' => 'required',
            'portDestination' => 'required',
            'shipmentMode' => 'required',
            'shipmentType' => 'required',
            'transportationMode' => 'required',
            'pickupDate' => 'nullable',
            'departureDate' => 'nullable',
            'cyClosingDate' => 'nullable',
            'etd' => 'required',
            'eta' => 'required',
            'deliveryDate' => 'nullable',
            'arrivalDate' => 'required',
            'maxWeight' => 'required',
            'maxVolume' => 'required',
            'price' => 'required',
            'total_cbm' => 'required',
            'total_price' => 'required',
            'selected_services' => 'nullable|array',
            'selected_services.*' => 'exists:services,id',
            'remainingWeight' => 'required',
            'remainingVolume' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'destinationAddress' => 'nullable',
            'originAddress' => 'nullable',
            'RTL_start_date'=> 'required',
            'RTL_end_date' => 'required',
            'lsp_id' => 'required',
            'truck_first_id' => 'nullable',
            'truck_second_id' => 'nullable',
            'cargoType' => 'nullable',
            'container_id' => 'nullable',
            'receiverName' => 'required',
            'receiverTelpNumber' => 'required',
        ]);

        $totalWeight = ceil(collect($attributes['items'])->sum('weight'));
        $totalVolume = ceil(collect($attributes['items'])->sum('volume'));
        if ($attributes['shipmentType'] === "LCL"){
            if ($attributes['total_cbm'] > $attributes['remainingVolume']) {
                throw ValidationException::withMessages([
                    'total_cbm' => 'Total CBM yang harus dibeli melebihi sisa volume yang tersedia.',
                ]);
            }
            if ($totalWeight > $attributes['remainingWeight']) {
                throw ValidationException::withMessages([
                    'weight' => 'Total berat barang melebihi sisa berat yang tersedia.',
                ]);
            }
        }
        $order = Order::where('noOffer', $attributes['noOffer'])->first();

        if (!$order) {
            $order = Order::create([
                "noOffer" => $attributes['noOffer'],
                "origin" => $attributes['origin'],
                "destination" => $attributes['destination'],
                "portDestination" => $attributes['portDestination'] ?? null,
                "portOrigin" => $attributes['portOrigin'] ?? null,
                "shipmentType" => $attributes['shipmentType'],
                "shipmentMode" => $attributes['shipmentMode'],
                "transportationMode" => $attributes['transportationMode'],
                "pickupDate" => $attributes['pickupDate'] ?? null,
                "departureDate" => $attributes['departureDate'] ?? null,
                "cyClosingDate" => $attributes['cyClosingDate'] ?? null,
                "etd" => $attributes['etd'],
                "eta" => $attributes['eta'],
                "deliveryDate" => $attributes['deliveryDate'] ?? null,
                "arrivalDate" => $attributes['arrivalDate'] ?? $attributes['eta'],
                "maxWeight" => $attributes['maxWeight'],
                "maxVolume" => $attributes['maxVolume'],
                "status" => "Loading Item",
                "remainingWeight" => $attributes['remainingWeight'] - $totalWeight,
                "remainingVolume" => $attributes['remainingVolume'] - $totalVolume,
                "price" => $attributes['price'],
                "totalAmount" => $attributes['total_price'],
                "paidAmount" => 0,
                "remainingAmount" => $attributes['total_price'],
                "remainingAmount" => $attributes['total_price'],
                "lsp_id" => $attributes['lsp_id'],
                "paymentStatus" => "Belum Lunas",
                "truck_first_id" => $attributes['truck_first_id'],
                "truck_second_id" => $attributes['truck_second_id'],
                "cargoType" => $attributes['cargoType'],
                "container_id" => $attributes['container_id'],
            ]);
        } else {
            $remainingWeight = $order->remainingWeight - $totalWeight;
            $remainingVolume = $order->remainingVolume - $totalVolume;
            $order->update([
                "remainingWeight" => max(0, $remainingWeight),
                "remainingVolume" => max(0, $remainingVolume),
                "totalAmount" => $order->totalAmount + $attributes['total_price'],
                "remainingAmount" => $order->remainingAmount + $attributes['total_price'],
                "paymentStatus" => "Belum Lunas"
            ]);
        }
        
        $userOrder = UserOrder::create([
            "user_id" => Auth::id(),
            "order_id" => $order->id,
            "receiverTelpNumber" => $attributes['receiverTelpNumber'],
            "receiverName" => $attributes['receiverName'],
            "RTL_start_date" => $attributes['RTL_start_date'],
            "RTL_end_date" => $attributes['RTL_end_date'],
            "originAddress" => $attributes['originAddress']??null,
            "destinationAddress" => $attributes['destinationAddress']??null,
            "description" => $attributes['description'],
            "totalPrice" => $attributes['total_price'],
            "invoiceNumber" => 'INV-' . date('YmdHis') . '-' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT),
            "paymentStatus" => "Belum Lunas",
            "payment_token" => Str::uuid(),
            "expires_at" => Carbon::now()->addDays(30),
        ]);

        $items = $request->input('items', []);
        foreach ($items as $item) {
            $itemPrice = ($item['volume'] ?? 1) * ($attributes['price'] ?? 0);
            UserOrderItem::create([
                "userOrder_id" => $userOrder->id,
                "weight" => $item['weight'],
                "width" => $item['width'] ?? 1,
                "height" => $item['height'] ?? 1,
                "length" => $item['length'] ?? 1,
                "volume" => $item['volume'],
                "qty" => $item['qty'],
                "price" => $itemPrice,
                "commodities" => $item['commodities'],
            ]);  
        }

        $selectedServices = $request->input('selected_services', []);
        foreach ($selectedServices as $serviceId) {
            ServiceOrdered::create([
                "userOrder_id" => $userOrder->id,
                "service_id" => $serviceId,
            ]);
        }

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
            ),
            'callbacks' => [
                'finish' => route('payment.success', ['token' => $userOrder->payment_token])
            ]
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $userOrder->snap_token = $snapToken;
        $userOrder->save();

        if($attributes['shipmentType']=="LCL"){
            $status = 'active';
            $is_for_lsp = true;
            $is_for_customer = true;
        } else {
            $status = 'deactive';
            $is_for_lsp = true;
            $is_for_customer = true;
        }

        $user_id = Bid::where('noOffer', $attributes['noOffer'])->first()->user_id;
        $offer = offersModel::create([
            "noOffer" => $attributes['noOffer'],
            "origin" => $attributes['origin'],
            "destination" => $attributes['destination'],
            "portOrigin" => $attributes['portOrigin'],
            "portDestination" => $attributes['portDestination'],
            "transportationMode" => $attributes['transportationMode'],
            "shipmentMode" => $attributes['shipmentMode'],
            "shipmentType" => $attributes['shipmentType'],
            "pickupDate" => $attributes['pickupDate'],
            "cyClosingDate" => $attributes['cyClosingDate'],
            "etd" => $attributes['etd'],
            "eta" => $attributes['eta'],
            "deliveryDate" => $attributes['deliveryDate'],
            "arrivalDate" => $attributes['arrivalDate'],
            "maxWeight" => $attributes['maxWeight'],
            "maxVolume" => $attributes['maxVolume'],
            "remainingWeight" => $attributes['maxWeight'] - $totalWeight,
            "remainingVolume" => $attributes['maxVolume'] - $totalVolume,
            "status" => $status,
            "price" => $attributes['price'],
            "cargoType" => $attributes['cargoType'],
            "user_id" => $user_id,
            "is_for_lsp" => $is_for_lsp,
            "is_for_customer" => $is_for_customer,
            "truck_first_id" => $attributes['truck_first_id'],
            "truck_second_id" => $attributes['truck_second_id'],
            "container_id" => $attributes['container_id'],
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
