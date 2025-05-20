<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationLspController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('receiver_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')->get();
            // ->paginate(10);
        return view('pages.lsp.notifications.index',compact('notifications'));
    }

    public function update_status(Request $request, $id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update(['is_read' => '1']);
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Notification not found.');
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
            return redirect()->back()->with('success', 'Notification deleted successfully.');
        }
        return redirect()->back()->with('error', 'Notification not found.');
    }

    public function markAllAsRead()
    {
        Notification::where('receiver_id', auth()->user()->id)
            ->update(['is_read' => '1']);
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
