<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tracking;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
    {
        $userOrder = UserOrder::with('order')
            ->where('user_id', Auth::id())
            ->where('paymentStatus','Lunas')
            ->get();      
        return view('pages.customer.tracking.index', compact('userOrder'));        
    }

    public function detail($id)
    {
        $userOrder = UserOrder::with(['order', 'order.lsp'])
            ->where('user_id', Auth::id())
            ->where('paymentStatus','Lunas')
            ->findOrFail($id);
        $tracking = Tracking::where('order_id', $userOrder->order->id)
            ->first();
        return view('pages.customer.tracking.detail', compact('userOrder', 'tracking'));
    }
}
