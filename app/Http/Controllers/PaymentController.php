<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($id)
    {
        $userOrder = UserOrder::find($id);
        $order = Order::find($userOrder->order_id);
        return view('pages.customer.orders.payment', compact('userOrder','order'));
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
}
