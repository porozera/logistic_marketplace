<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQCustomerController extends Controller
{
    public function index()
    {
        return view('pages.customer.FAQ.index');
    }
}
