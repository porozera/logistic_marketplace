<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $offers = offersModel::latest()->take(6)->get();
        return view('landing-page',compact('offers'));
    }

    public function search_route(Request $request)
    {
        $query = offersModel::where('is_for_customer', true)
            ->where('status', "active")
            ->whereDate('shippingDate', '>=', Carbon::today());
    
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

        if ($request->has('category') && $request->category != '') {
            $query->where(function ($q) use ($request) {
                foreach ($request->category as $category) {
                    $q->orWhere('cargoType', $category);
                }
            });
            $searchPerformed = true;
        }

        if ($request->has('container') && $request->filled('container')) {
            $query->whereIn('container_id', $request->container);
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

        $offers = $query->orderBy('created_at', 'desc')->get();
    
        return view('landing-search-route', compact('offers', 'searchPerformed'));
    }
}
