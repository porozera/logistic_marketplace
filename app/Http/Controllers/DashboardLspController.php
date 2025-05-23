<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardLspController extends Controller
{
    public function index()
    {
        $totalPengiriman = UserOrder::where('user_id', Auth::id())
            ->where('paymentStatus', 'Lunas')
            ->count();

        $pembayaranTertunda = UserOrder::where('user_id', Auth::id())
            ->where('paymentStatus', 'Belum Lunas')
            ->count();

        $pengirimanBerjalan = UserOrder::where('user_id', Auth::id())
            ->where('paymentStatus', 'Lunas')
            ->whereHas('order', function ($query) {
                $query->where('status', '!=', 'Finished');
            })
            ->count();

        $orderIds = UserOrder::where('user_id', Auth::id())
            ->where('paymentStatus', 'Lunas')
            ->pluck('order_id');

        $latestTrackings = Tracking::with('order')
            ->whereIn('order_id', $orderIds)
            ->latest()
            ->get()
            ->unique('order_id');


        $userOrder = UserOrder::with(['order', 'order.lsp'])
            ->where('user_id', Auth::id())
            ->where('paymentStatus', 'Lunas')
            ->whereHas('order', function ($query) {
            $query->where('status', '!=', 'Finished');
            })
            ->get();

        return view('pages.lsp.dashboard.index', compact(
            'totalPengiriman',
            'pembayaranTertunda',
            'pengirimanBerjalan',
            'userOrder',
            'latestTrackings'
        ));
    }
}
