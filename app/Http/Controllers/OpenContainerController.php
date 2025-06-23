<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Container;
use App\Models\offersModel;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OpenContainerController extends Controller
{
    public function index(Request $request)
    {
        $query = offersModel::where('is_for_lsp', true)
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

        if ($request->has('arrivalDate') && $request->arrivalDate != '') {
            $query->whereDate('arrivalDate', $request->arrivalDate);
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
        $services = Service::all();
        $categories = Category::distinct('type')->pluck('type')->toArray();
        $containers = Container::all();
        $cities = City::pluck('name')->toArray();

        return view('pages.lsp.opencontainer.index', compact('offers', 'searchPerformed', 'cities','services','categories','containers'));
    }
}
