<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQCustomerController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::query();

        if ($request->filled('header')) {
            $faqs->where('header', 'like', '%' . $request->header . '%');
        }

        $faqs = $faqs->get();

        return view('pages.customer.FAQ.index', compact('faqs'));
    }
}
