<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;

class offerController extends Controller
{
    public function index(Request $request)
    {
        $offers = offersModel::select('id', 'origin', 'destination', 'shipmentType')->get();
        // return view('lsp.kelola-rute', compact('offers'));

        $query = offersModel::query();
        // Filter
        if ($request->filled('origin')) {
            $query->where('origin', $request->origin);
        }
        if ($request->filled('destination')) {
            $query->where('destination', $request->destination);
        }
        if ($request->filled('shipmentType')) {
            $query->where('shipmentType', $request->shipmentType);
        }

        // $offers = $query->paginate(10);

        // Ambil data unik untuk filter
        $origins = offersModel::select('origin')->distinct()->pluck('origin');
        $destinations = offersModel::select('destination')->distinct()->pluck('destination');

        // return view('lsp.kelola-rute', compact('offers', 'origins', 'destinations'));

        if ($request->ajax()) {
            return view('pages.lsp.kelola-rute.index', compact('offers'))->render();
        }

        return view('pages.lsp.kelola-rute.index', compact('offers', 'origins', 'destinations'));
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


        public function create()
    {
        return view('pages.lsp.kelola-rute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'noOffer' => 'required|unique:offers,noOffer',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'shipmentMode' => 'required|in:laut,darat',
            'shipmentType' => 'required|in:FCL,LCL',
            'maxWeight' => 'required|integer',
            'maxVolume' => 'required|integer',
            'commodities' => 'nullable|string',
            'status' => 'required|in:active,deactive',
            'price' => 'required|numeric',
            'loadingDate' => 'required|date',
            'shippingDate' => 'required|date',
            'estimationDate' => 'required|date',
            'remainingWeight' => 'nullable|integer',
            'remainingVolume' => 'nullable|integer',
        ]);

        offersModel::create($request->all());

        return redirect()->route('offers.index')->with('success', 'Offer successfully created!');
    }

    public function show($id)
    {
    $offer = offersModel::findOrFail($id);
    return view('pages.lsp.kelola-rute.show-details', compact('offer'));
    }

    public function edit($id)
    {
        $offer = offersModel::findOrFail($id);
        return view('pages.lsp.kelola-rute.edit', compact('offer'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'noOffer' => 'required|string|unique:offers,noOffer,' . $id,
            'origin' => 'required|string',
            'destination' => 'required|string',
            'shipmentMode' => 'required|in:laut,darat',
            'shipmentType' => 'required|in:FCL,LCL',
            'maxWeight' => 'required|integer',
            'maxVolume' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Cari offer berdasarkan ID
        $offer = offersModel::findOrFail($id);

        // Update data
        $offer->update([
            'noOffer' => $request->noOffer,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'shipmentMode' => $request->shipmentMode,
            'shipmentType' => $request->shipmentType,
            'maxWeight' => $request->maxWeight,
            'maxVolume' => $request->maxVolume,
            'price' => $request->price,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }


    public function destroy($id)
    {
        // Cari offer berdasarkan ID
        $offer = offersModel::findOrFail($id);

        // Hapus offer
        $offer->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }




}
