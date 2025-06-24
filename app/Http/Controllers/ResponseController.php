<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'complain_id' => 'required|exists:complains,id',
            'message' => 'required|string',
        ]);

        Response::create([
            'complain_id' => $request->complain_id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'sender' => auth()->user()->is_admin ? 'admin' : 'customer',
        ]);

        return back()->with('success', 'Response berhasil dikirim.');
    }
}
