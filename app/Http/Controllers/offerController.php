<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;

class offerController extends Controller
{
    public function index()
    {
        $offers = offersModel::select('id', 'origin', 'destination', 'shipmentType')->get();
        return view('lsp.kelola-rute', compact('offers'));
    }

    public function search(Request $request)
    {
        $offers = offersModel::where('origin', 'like', '%' . $request->search . '%')
            ->orWhere('destination', 'like', '%' . $request->search . '%')
            ->orWhere('shipmentType', 'like', '%' . $request->search . '%')
            ->get();

        $html = '';

        if ($offers->isNotEmpty()) {
            foreach ($offers as $offer) {
                $html .= '
                    <tr>
                        <td>' . $offer->id . '</td>
                        <td>' . $offer->origin . '</td>
                        <td>' . $offer->destination . '</td>
                        <td>' . $offer->shipmentType . '</td>
                        <td class="text-end"><a href="#">Lihat Detail</a></td>
                    </tr>';
            }
        } else {
            $html = '<tr><td colspan="5" class="text-center">No offers found.</td></tr>';
        }

        return response()->json($html);
    }


}
