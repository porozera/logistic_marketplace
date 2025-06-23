<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->whereDate(DB::raw('COALESCE(departureDate, etd)'), '>=', Carbon::today());
    
        $searchPerformed = false;
    
        if ($request->has('origin') && $request->origin != '') {
            $query->where('origin', 'LIKE', '%' . $request->origin . '%');
            $searchPerformed = true;
        }
    
        if ($request->has('destination') && $request->destination != '') {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
            $searchPerformed = true;
        }
    
        if ($request->filled('departureDate') && $request->filled('arrivalDate')) {
            $query->whereDate(DB::raw('COALESCE(departureDate, etd)'), '>=', $request->departureDate)
                ->whereDate(DB::raw('COALESCE(arrivalDate, eta)'), '<=', $request->arrivalDate);
            $searchPerformed = true;
        } elseif ($request->filled('departureDate')) {
            $query->whereDate(DB::raw('COALESCE(departureDate, etd)'), $request->departureDate);
            $searchPerformed = true;
        } elseif ($request->filled('arrivalDate')) {
            $query->whereDate(DB::raw('COALESCE(arrivalDate, eta)'), $request->arrivalDate);
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
            $query->whereRaw("
                DATEDIFF(
                    COALESCE(arrivalDate, eta),
                    COALESCE(pickupDate, departureDate, etd)
                ) <= ?
            ", [$request->maxTime]);
            $searchPerformed = true;
        }
    
        if ($request->has('btn_radio1')) {
            if ($request->btn_radio1 == 'Murah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->btn_radio1 == 'Cepat') {
                $query->orderByRaw("DATEDIFF(arrivalDate, etd) asc");
            }
            $searchPerformed = true;
        }

        $offers = $query->orderBy('created_at', 'desc')->get();
    
        return view('landing-search-route', compact('offers', 'searchPerformed'));
    }
}
