<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Order;
use App\Models\Tracking;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class PaymentController extends Controller
{
    public function index($token)
    {
        $userOrder = UserOrder::where('payment_token', $token)->firstOrFail();
        $order = Order::find($userOrder->order_id);
        return view('pages.customer.orders.payment', compact('userOrder', 'order'));
    }

    public function success($token)
    {
        $userOrder = UserOrder::where('payment_token', $token)->first();
    
        if (!$userOrder || $userOrder->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Akses tidak sah!');
        }
    
        $userOrder->paymentStatus = 'Lunas';
        $userOrder->save();
    
        $order = Order::find($userOrder->order_id);
    
        if ($order) {
            $order->remainingAmount -= $userOrder->totalPrice;
            $order->paidAmount += $userOrder->totalPrice;
    
            if ($order->remainingAmount == 0 || $order->paidAmount == $order->totalAmount){
                $order->paymentStatus = 'Lunas'; 
            }
    
            $order->save();
        }

        $tracking = Tracking::create([
            'order_id' => $userOrder->order_id,
            'currentLocation' => 'Warehouse',
            'currentVehicle' => 'Truck',
            'status' => 'Loading Item',
            'description' => 'Sedang tahap loading muatan.',
            'longitude' => null,
            'latitude' => null,
        ]);
        $tracking->save();

        $userOrderItem = UserOrder::where('payment_token', $token)->first();
        $orderItem = Order::find($userOrder->order_id);
        return view('pages.customer.orders.success',compact('userOrderItem','orderItem'));
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
