<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;

class OpenContainerController extends Controller
{
    public function index()
    {
        return view('pages.lsp.opencontainer.index');
    }

    public function search(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');

        $offers = offersModel::where('is_for_lsp', true)
            ->where('shipmentType', 'LCL')
            ->where('status', 'active')
            ->when($origin, function ($query, $origin) {
                return $query->where('origin', 'like', "%$origin%");
            })
            ->when($destination, function ($query, $destination) {
                return $query->where('destination', 'like', "%$destination%");
            })
            ->get();

        return response()->json($offers);
    }
}
