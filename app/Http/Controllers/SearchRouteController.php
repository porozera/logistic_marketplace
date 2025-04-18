<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\offersModel;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
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
    
        $categoryFilters = $request->input('category', []);

        if (!empty($categoryFilters)) {
            $query->where(function ($q) use ($categoryFilters) {
                foreach ($categoryFilters as $category) {
                    if ($category === 'General Cargo') {
                        $q->orWhere('commodities', 'LIKE', '%Pakaian%')
                        ->orWhere('commodities', 'LIKE', '%Makanan%')
                        ->orWhere('commodities', 'LIKE', '%Alat Olah Raga%')
                        ->orWhere('commodities', 'LIKE', '%Tas%')
                        ->orWhere('commodities', 'LIKE', '%Peralatan Rumah Tangga%')
                        ->orWhere('commodities', 'LIKE', '%Peralatan Kantor%')
                        ->orWhere('commodities', 'LIKE', '%Sepatu%')
                        ->orWhere('commodities', 'LIKE', '%Elektronik%');
                    } elseif ($category === 'Dangerous Cargo') {
                        $q->orWhere('commodities', 'LIKE', '%Senjata%')
                        ->orWhere('commodities', 'LIKE', '%Cairan Kimia%')
                        ->orWhere('commodities', 'LIKE', '%Peledak%')
                        ->orWhere('commodities', 'LIKE', '%Petasan%')
                        ->orWhere('commodities', 'LIKE', '%Puluru%');
                    } elseif ($category === 'Special Cargo') {
                        $q->orWhere('commodities', 'LIKE', '%Hewan%')
                        ->orWhere('commodities', 'LIKE', '%Makanan Segar%')
                        ->orWhere('commodities', 'LIKE', '%Tanaman Hias%')
                        ->orWhere('commodities', 'LIKE', '%Emas%')
                        ->orWhere('commodities', 'LIKE', '%Berlian%');
                    }
                }
            });
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
        $services = Service::all();
        $categories = Category::distinct('type')->pluck('type')->toArray();
        $cities = City::pluck('name')->toArray();
    
        return view('pages.customer.search_routes.index', compact('offers', 'searchPerformed', 'cities','services','categories'));
    }
    
    public function detail($id)
    {
        $offer = offersModel::with('user')->find($id);
        $services = Service::all();
        $order = null;
        if ($offer && isset($offer->noOffer)) { 
            $order = Order::where('noOffer', $offer->noOffer)->first() ?? null;
        }
        return view('pages.customer.search_routes.detail', compact('offer','services','order'));
    }

    public function profile_lsp($id){
        $lsp = User::find($id);
        return view('pages.customer.search_routes.profile_lsp', compact('lsp'));
    }
}
