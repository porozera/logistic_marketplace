<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use Illuminate\Http\Request;

class SearchRouteController extends Controller
{
    public function index()
    {
        $offers = offersModel::where('is_for_customer', true)->get();
        return view('pages.customer.search_routes.index',compact('offers'));
    }
}
