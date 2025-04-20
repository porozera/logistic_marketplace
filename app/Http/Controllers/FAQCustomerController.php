<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FAQCustomerController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('pages.customer.FAQ.index', compact('faqs'));
    }
}
