<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationCustomerController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('receiver_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')->get();
            // ->paginate(10);
        return view('pages.customer.notifications.index',compact('notifications'));
    }
}
