<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('customer_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.customer.review.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'description' => 'required',
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

    public function edit($id)
    {
        $reviews = Review::findOrFail($id);
        return view('pages.customer.review.edit', compact('reviews'));
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'description' => 'required',
            'ratingNumber' => 'required|integer|between:1,5',
        ]);

        $review = Review::where('id', $id)->where('customer_id', Auth::id())->firstOrFail();
        $review->update([
            'description' => $attributes['description'],
            'ratingNumber' => $attributes['ratingNumber'],
        ]);
        return redirect()->route('review')->with('success', 'Review berhasil diubah.');
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)->where('customer_id', Auth::id())->firstOrFail();
        $review->delete();
        return redirect()->route('review')->with('success', 'Review berhasil dihapus.');
    }
}
