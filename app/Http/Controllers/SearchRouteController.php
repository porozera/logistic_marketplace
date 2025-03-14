<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchRouteController extends Controller
{
    public function index()
    {
        $offers = offersModel::where('is_for_customer', true)->get();
        return view('pages.customer.search_routes.index',compact('offers'));
    }

    public function detail($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        return view('pages.customer.search_routes.detail', compact('offer','services'));
    }
}
