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
}
