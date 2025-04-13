<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        return view('pages.customer.review.index');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'description' => 'required|string|max:255',
            'ratingNumber' => 'required|integer|between:1,5',
            'lsp_id' => 'required',
            'order_id' => 'required',
        ]);

        Review::create([
            'description' => $attributes['description'],
            'ratingNumber' => $attributes['ratingNumber'],
            'customer_id' => Auth::id(),
            'lsp_id' => $attributes['lsp_id'],
            'order_id' => $attributes['order_id'],
        ]);
        return redirect()->back()->with('success', 'Review berhasil ditambahkan.');
    }
}
