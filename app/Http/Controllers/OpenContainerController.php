<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;

class OpenContainerController extends Controller
{
    // public function index()
    // {
    //     return view('pages.lsp.opencontainer.index', [
    //         'offers' => collect([]), // Set default sebagai koleksi kosong
    //         'searchPerformed' => false // Menandakan belum ada pencarian dilakukan
    //     ]);
    // }
    public function index(Request $request)
{
    $searchPerformed = false;
    $offers = collect([]); // Default: Kosong saat pertama kali dibuka

    if ($request->has('origin') || $request->has('destination') || $request->has('shippingDate') || $request->has('shipmentMode')) {
        $searchPerformed = true;

        $query = offersModel::query()
            ->where('is_for_lsp', true)
            ->where('shipmentType', 'LCL')
            ->where('status', 'active');

        if ($request->filled('origin')) {
            $query->where('origin', 'LIKE', '%' . $request->origin . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
        }

        if ($request->filled('shippingDate')) {
            $query->whereDate('shippingDate', $request->shippingDate);
        }

        if ($request->filled('shipmentMode')) {
            $query->where('shipmentMode', $request->shipmentMode);
        }

        $offers = $query->with('user:id,username,profilePicture,rating')->get();
    }

    return view('pages.lsp.opencontainer.index', compact('offers', 'searchPerformed'));
}

    // public function search(Request $request)
    // {
    //     $origin = $request->input('origin');
    //     $destination = $request->input('destination');

    //     $offers = offersModel::where('is_for_lsp', true)
    //         ->where('shipmentType', 'LCL')
    //         ->where('status', 'active')
    //         ->when($origin, function ($query, $origin) {
    //             return $query->where('origin', 'like', "%$origin%");
    //         })
    //         ->when($destination, function ($query, $destination) {
    //             return $query->where('destination', 'like', "%$destination%");
    //         })
    //         ->get();

    //     return response()->json($offers);
    // }

    // search works pake javascript
//     public function search(Request $request)
// {
//     $query = offersModel::where('is_for_lsp', true)
//         ->where('shipmentType', 'LCL')
//         ->where('status', 'active');

//     if ($request->has('origin') && !empty($request->origin)) {
//         $query->where('origin', 'LIKE', "%{$request->origin}%");
//     }
//     if ($request->has('destination') && !empty($request->destination)) {
//         $query->where('destination', 'LIKE', "%{$request->destination}%");
//     }
//     if ($request->has('shippingDate') && !empty($request->shippingDate)) {
//         $query->whereDate('shippingDate', $request->shippingDate);
//     }
//     if ($request->has('shipmentMode') && !empty($request->shipmentMode)) {
//         $query->where('shipmentMode', $request->shipmentMode);
//     }

//     return response()->json($query->get());
// }

// public function search(Request $request)
// {
//     $searchPerformed = true; // Menandakan bahwa pencarian telah dilakukan

//     $query = offersModel::query()
//         ->where('is_for_lsp', true)
//         ->where('shipmentType', 'LCL')
//         ->where('status', 'active');

//     // Filter berdasarkan input pencarian
//     if ($request->filled('origin')) {
//         $query->where('origin', 'LIKE', '%' . $request->origin . '%');
//     }

//     if ($request->filled('destination')) {
//         $query->where('destination', 'LIKE', '%' . $request->destination . '%');
//     }

//     if ($request->filled('shippingDate')) {
//         $query->whereDate('shippingDate', $request->shippingDate);
//     }

//     if ($request->filled('shipmentMode')) {
//         $query->where('shipmentMode', $request->shipmentMode);
//     }

//     // Ambil data dan join dengan tabel users untuk mendapatkan foto profil LSP
//     $offers = $query->with('user:id,username,profilePicture,rating')->get();

//     return view('pages.lsp.opencontainer.index', compact('offers', 'searchPerformed'));
// }


}
