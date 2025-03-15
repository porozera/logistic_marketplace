<?php

namespace App\Http\Controllers;

use App\Models\offersModel;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchRouteController extends Controller
{
    public function index(Request $request)
    {
        $query = offersModel::where('is_for_customer', true);
    
        // Cek apakah ada input pencarian
        $searchPerformed = false;
    
        if ($request->has('origin') && $request->origin != '') {
            $query->where('origin', 'LIKE', '%' . $request->origin . '%');
            $searchPerformed = true;
        }
    
        if ($request->has('destination') && $request->destination != '') {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
            $searchPerformed = true;
        }
    
        // Filter berdasarkan tanggal pengiriman
        if ($request->has('shippingDate') && $request->shippingDate != '') {
            $query->whereDate('shippingDate', $request->shippingDate);
            $searchPerformed = true;
        }
    
        // Filter berdasarkan jenis pengiriman (FCL/LCL)
        if ($request->has('shipmentType') && in_array($request->shipmentType, ['FCL', 'LCL'])) {
            $query->where('shipmentType', $request->shipmentType);
            $searchPerformed = true;
        }
    
        // Filter berdasarkan harga maksimal
        if ($request->has('maxPrice') && $request->maxPrice != '') {
            $query->where('price', '<=', $request->maxPrice);
            $searchPerformed = true;
        }
    
        // Filter berdasarkan layanan tambahan
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
    
        // Filter berdasarkan waktu maksimal (estimasi waktu)
        if ($request->has('maxTime') && $request->maxTime != '') {
            $query->whereRaw("DATEDIFF(estimationDate, shippingDate) <= ?", [$request->maxTime]);
            $searchPerformed = true;
        }
    
        // Filter berdasarkan pilihan (Murah atau Cepat)
        if ($request->has('btn_radio1')) {
            if ($request->btn_radio1 == 'Murah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->btn_radio1 == 'Cepat') {
                $query->orderByRaw("DATEDIFF(estimationDate, shippingDate) asc");
            }
            $searchPerformed = true;
        }
    
        $offers = $query->get();
    
        return view('pages.customer.search_routes.index', compact('offers', 'searchPerformed'));
    }
    
    public function detail($id)
    {
        $offer = offersModel::find($id);
        $services = Service::all();
        return view('pages.customer.search_routes.detail', compact('offer','services'));
    }
}
