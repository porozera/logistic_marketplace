<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\offersModel;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchRouteController extends Controller
{
    public function index(Request $request)
    {
        $query = offersModel::where('is_for_customer', true)
            ->where('status', "active");
    
        $searchPerformed = false;
    
        if ($request->has('origin') && $request->origin != '') {
            $query->where('origin', 'LIKE', '%' . $request->origin . '%');
            $searchPerformed = true;
        }
    
        if ($request->has('destination') && $request->destination != '') {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
            $searchPerformed = true;
        }
    
        if ($request->has('shippingDate') && $request->shippingDate != '') {
            $query->whereDate('shippingDate', $request->shippingDate);
            $searchPerformed = true;
        }
    
        if ($request->has('shipmentType') && in_array($request->shipmentType, ['FCL', 'LCL'])) {
            $query->where('shipmentType', $request->shipmentType);
            $searchPerformed = true;
        }
    
        if ($request->has('maxPrice') && $request->maxPrice != '') {
            $query->where('price', '<=', $request->maxPrice);
            $searchPerformed = true;
        }
    
        if ($request->has('insurance')) {
            $query->where('commodities', 'LIKE', '%Asuransi%');
            $searchPerformed = true;
        }
    
        if ($request->has('storage')) {
            $query->where('commodities', 'LIKE', '%Tempat penyimpanan%');
            $searchPerformed = true;
        }
    
        if ($request->has('fragile')) {
            $query->where('commodities', 'LIKE', '%Barang pecah belah%');
            $searchPerformed = true;
        }
    
        if ($request->has('maxTime') && $request->maxTime != '') {
            $query->whereRaw("DATEDIFF(estimationDate, shippingDate) <= ?", [$request->maxTime]);
            $searchPerformed = true;
        }
    
        if ($request->has('btn_radio1')) {
            if ($request->btn_radio1 == 'Murah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->btn_radio1 == 'Cepat') {
                $query->orderByRaw("DATEDIFF(estimationDate, shippingDate) asc");
            }
            $searchPerformed = true;
        }

        $offers = $query->get();
        $services = Service::all();
        $cities = City::pluck('name')->toArray();
    
        return view('pages.customer.search_routes.index', compact('offers', 'searchPerformed', 'cities','services'));
    }
    
    public function detail($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        return view('pages.customer.search_routes.detail', compact('offer','services'));
    }
}
