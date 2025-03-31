<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
    {
        $userOrder = UserOrder::with('order')
            ->where('user_id', Auth::id())
            ->get();      
        return view('pages.customer.tracking.index', compact('userOrder'));        
    }
}
