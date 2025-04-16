<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplainController extends Controller
{
    public function index() {
        $complains = Complain::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('pages.customer.complains.index', compact('complains'));
    } 

    public function create() {
        $user = Auth::user();
        return view('pages.customer.complains.create', compact('user'));
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'description' => 'required',
            'header' => 'required',
            'email' => 'required|email',
            'user_id' => 'required',
        ]);
        $complain = Complain::create([
            'description' => $attributes['description'],
            'header' => $attributes['header'],
            'email' => $attributes['email'],
            'user_id' => $attributes['user_id'],
            'is_answered' => false,
        ]);

        return redirect()->route('complain')->with('success', 'Complain submitted successfully.');
    }

    public function detail($id) {
        $complain = Complain::findOrFail($id);
        return view('pages.customer.complains.detail', compact('complain'));
    }
}
