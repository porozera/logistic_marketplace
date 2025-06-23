<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\ServiceOrdered;
use App\Models\Tracking;
use App\Models\UserOrder;
use App\Models\UserOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
    {
        $userOrder = UserOrder::with('order')
            ->where('user_id', Auth::id())
            ->where('paymentStatus','Lunas')
            ->orderBy('created_at', 'desc')
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
            ->orderBy('created_at', 'desc')
            ->get();
        $location = Tracking::where('order_id', $userOrder->order->id)
            ->orderBy('created_at', 'desc') 
            ->first();
        $review = Review::where('order_id', $userOrder->order->id)
            ->where('customer_id', Auth::id())
            ->count();
        $services = ServiceOrdered::with('service')->where('userOrder_id', $userOrder->id)->get();
        $serviceNames = $services->pluck('service.serviceName')->unique()->implode(', ');
        $items = UserOrderItem::where('userOrder_id', $userOrder->id)->get();
        return view('pages.customer.tracking.detail', compact('userOrder', 'tracking','location','review','serviceNames','services', 'items'));
    }
}
