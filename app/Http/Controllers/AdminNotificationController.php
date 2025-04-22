<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::where('receiver_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pages.admin.notifications.notification', compact('notifications'));
}

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        return back()->with('success', 'Notifikasi ditandai sebagai telah dibaca.');
    }

    public function markAllAsRead()
    {
        Notification::where('receiver_id', Auth::id())->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi ditandai sebagai telah dibaca.');
    }

    public function delete($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notifikasi dihapus.');
    }
}
