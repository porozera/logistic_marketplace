<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Order;
use App\Models\ServiceOrdered;
use App\Models\Tracking;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class PaymentController extends Controller
{
    public function index($token)
    {
        $userOrder = UserOrder::where('payment_token', $token)->firstOrFail();
        $item = UserOrderItem::where('userOrder_id', $userOrder->id)->get();
        $totalWeight = $item->sum(function ($i) {
            return $i->weight * $i->qty;
        });
        $totalVolume = $item->sum(function ($i) {
            return $i->volume * $i->qty;
        });
        $itemName = $item->pluck('commodities')->unique()->implode(', ');
        $services = ServiceOrdered::with('service')->where('userOrder_id', $userOrder->id)->get();
        $serviceNames = $services->pluck('service.serviceName')->unique()->implode(', ');
        $order = Order::find($userOrder->order_id);
        return view('pages.customer.orders.payment', compact('userOrder', 'order','totalWeight','totalVolume','itemName','serviceNames','services'));
    }

    public function failed(){
        return view('pages.customer.orders.failed');
    }

    public function success($token)
    {
        $userOrder = UserOrder::where('payment_token', $token)->first();
    
        if (!$userOrder || $userOrder->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Akses tidak sah!');
        }
    
        if ($userOrder->paymentStatus !== 'Lunas') {
            $userOrder->paymentStatus = 'Lunas';
            $userOrder->save();
    
            $order = Order::find($userOrder->order_id);
    
            if ($order) {
                $totalPaid = UserOrder::where('order_id', $order->id)
                                ->where('paymentStatus', 'Lunas')
                                ->sum('totalPrice');
    
                $order->paidAmount = $totalPaid;
                $order->remainingAmount = $order->totalAmount - $totalPaid;
    
                $countPaid = UserOrder::where('order_id', $order->id)
                                ->where('paymentStatus', 'Lunas')
                                ->count();
    
                if ($countPaid === 1) {
                    $order->status = 'Loading Item';
    
                    if (!Tracking::where('order_id', $order->id)->exists()) {
                        Tracking::create([
                            'order_id' => $order->id,
                            'currentLocation' => 'Warehouse',
                            'currentVehicle' => 'Truck',
                            'status' => 'Loading Item',
                            'description' => 'Sedang tahap loading muatan.',
                            'longitude' => 106.816666,
                            'latitude' => -6.200000,
                        ]);
                    }
                }
    
                if ($order->remainingAmount <= 0) {
                    $order->paymentStatus = 'Lunas';
                }
    
                $order->save();
            }
        }
    
        $userOrderItem = $userOrder;
        $orderItem = Order::find($userOrder->order_id);
    
        return view('pages.customer.orders.success', compact('userOrderItem', 'orderItem'));
    }
    

    
    public function list_payment(){
        $userOrders = UserOrder::where('user_id', Auth::id())
                        ->with('order')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('pages.customer.orders.list-payment', compact('userOrders'));
    }

    public function invoice($token){
        $userOrder = UserOrder::where('payment_token', $token)->first();
        if (!$userOrder) {
            return redirect('/')->with('error', 'Order not found.');
        }
        $order = Order::find($userOrder->order_id);
        $offer = offersModel::where('noOffer', $order->noOffer)->first();
        return view('pages.customer.orders.invoice', compact('userOrder','order','offer'));
    }

    public function invoice_download($token)
    {
        $userOrder = UserOrder::with('order')->where('payment_token', $token)->first();
    
        if (!$userOrder) {
            abort(404, 'Invoice tidak ditemukan');
        }
    
        $order = $userOrder->order; // sudah eager-loaded
        $offer = offersModel::where('noOffer', $order->noOffer)->first();
    
        $pdf = Pdf::loadView('invoices.pdf', compact('userOrder'))
                  ->setPaper('A4', 'portrait');
    
        return $pdf->download('invoice-' . $order->noOffer . '.pdf');
    }
    
}
