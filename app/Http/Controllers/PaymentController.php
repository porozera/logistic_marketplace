<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        $userOrder = UserOrder::find($id);
        $order = Order::find($userOrder->order_id);
        return view('pages.customer.orders.payment', compact('userOrder','order'));
    }

    public function success($id)
    {
        $userOrder = UserOrder::find($id);
        
        if (!$userOrder) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }
    
        $userOrder->paymentStatus = 'Lunas';
        $userOrder->save();
    
        $order = Order::find($userOrder->order_id);
        
        if ($order) {
            $order->remainingAmount -= $userOrder->totalPrice;
            $order->paidAmount += $userOrder->totalPrice;
            $order->save();
        }
    
        return view('pages.customer.orders.success');
    }
    
}
