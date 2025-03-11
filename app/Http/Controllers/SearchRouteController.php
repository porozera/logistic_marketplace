<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchRouteController extends Controller
{
    public function index()
    {
        return view('pages.customer.search_routes.index');
    }
}
