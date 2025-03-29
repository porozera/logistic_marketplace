<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationCustomerController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('pages.customer.notifications.index',compact('notifications'));
    }
}
