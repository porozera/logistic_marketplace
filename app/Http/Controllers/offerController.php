<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\offersModel;
use App\Models\Truck;
use App\Models\Container;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
        // $trucks = Truck::all(); // Ambil semua data truck
        $trucks = Truck::with('user')
            ->where('user_id', Auth::id())
            ->get();

        $containers = Container::all(); // Ambil semua data container
        $commodities = Category::all();
        return view('pages.lsp.kelola-rute.create', compact('trucks', 'containers', 'commodities'));

    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'shipmentMode' => 'required|in:D2D,D2P,P2D,P2P',
            'shipmentType' => 'required|in:FCL,LCL',
            'maxWeight' => 'required|integer',
            'maxVolume' => 'required|integer',
            'status' => 'required|in:active,deactive',
            'price' => 'required|numeric',
            'remainingWeight' => 'nullable|integer',
            'remainingVolume' => 'nullable|integer',
            'container_id' => 'required|exists:containers,id',
            'truck_first_id' => 'required|exists:trucks,id',
            'truck_second_id' => 'required|exists:trucks,id',
            'portOrigin' => 'nullable|string',
            'portDestination' => 'nullable|string',
            'transportationMode' => 'required|in:darat,laut',
            'pickupDate' => 'nullable|date',
            'cyClosingDate' => 'nullable|date',
            'etd' => 'nullable|date',
            'eta' => 'nullable|date',
            'arrivalDate' => 'nullable|date',
            'deliveryDate' => 'nullable|date',
            'departureDate' => 'nullable|date',
            'cargoType' => 'required',
        ]);
        $noOffer = 'OFR-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        // $category = Category::where('name', $attributes['commodities'])->first();
        // $cargoType = $category->type ?? null;
        // Jika etd kosong dan mode transportasi darat D2D
        if (empty($attributes['etd']) &&
            $attributes['transportationMode'] === 'darat' &&
            $attributes['shipmentMode'] === 'D2D') {
            $attributes['etd'] = $attributes['departureDate'];
        }

        // dd($request->all());
        $offer = offersModel::create([
            // 'noOffer' => $attributes['noOffer'],
            'noOffer' => $noOffer,
            'lspName' => Auth::user()->username,
            'origin' => $attributes['origin'],
            'destination' => $attributes['destination'],
            'shipmentMode' => $attributes['shipmentMode'],
            'shipmentType' => $attributes['shipmentType'],
            // 'loadingDate' => $attributes['loadingDate'],
            // 'shippingDate' => $attributes['shippingDate'],
            // 'estimationDate' => $attributes['estimationDate'],
            'maxWeight' => $attributes['maxWeight'],
            'maxVolume' => $attributes['maxVolume'],
            'remainingWeight' => $attributes['remainingWeight'],
            'remainingVolume' => $attributes['remainingVolume'],
            // 'commodities' => $attributes['commodities'],
            'status' => $attributes['status'],
            'price' => $attributes['price'],
            'user_id' =>Auth::id(),
            // 'truck_id' => $attributes['truck_id'],
            'container_id' => $attributes['container_id'],
            'truck_first_id' => $attributes['truck_first_id'],
            'truck_second_id' => $attributes['truck_second_id'],
            'is_for_customer' => 1,
            'is_for_lsp' => $attributes['shipmentType'] === 'LCL' ? 1 : 0,
            'timestamp' => now(),
            'cargoType' => $attributes['cargoType'],
            'portOrigin'=> $attributes['portOrigin'],
            'portDestination'=> $attributes['portDestination'],
            'transportationMode'=> $attributes['transportationMode'],
            'pickupDate'=> $attributes['pickupDate'],
            'cyClosingDate'=> $attributes['cyClosingDate'],
            'etd'=> $attributes['etd'],
            'eta'=> $attributes['eta'],
            'arrivalDate'=> $attributes['arrivalDate'],
            'deliveryDate'=> $attributes['deliveryDate'],
            'departureDate'=> $attributes['departureDate'],
        ]);
        return redirect()->route('offers.index')->with('success', 'Route successfully created!');
    }

    public function show($id)
    {
    $offer = offersModel::findOrFail($id);
    return view('pages.lsp.kelola-rute.show-details', compact('offer'));
    }

    public function edit($id)
    {
        $offer = offersModel::findOrFail($id);
        $trucks = Truck::all();
        $containers= Container::all();
        $commodities = Category::all();
        return view('pages.lsp.kelola-rute.edit', compact('offer', 'trucks', 'containers', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            // // 'noOffer' => 'required|string|unique:offers,noOffer,' . $id,
            // // 'origin' => 'required|string',
            // // 'destination' => 'required|string',
            // 'shipmentMode' => 'required|in:D2D,D2P,P2D,P2P',
            // 'shipmentType' => 'required|in:FCL,LCL',
            // // 'maxWeight' => 'required|integer',
            // // 'maxVolume' => 'required|integer',
            // 'commodities' => 'required|string',
            // 'price' => 'required|numeric',
            // 'truck_first_id' => 'required|exists:trucks,id',
            // 'truck_second_id' => 'required|exists:trucks,id',
            // 'container_id' => 'required|exists:containers,id',
            // 'status' => 'required|in:active,deactive',
            'noOffer' => 'string|max:255',
            'origin' => 'string|max:255',
            'destination' => 'string|max:255',
            'portOrigin' => 'string|max:255',
            'portDestination' => 'string|max:255',
            'shipmentMode' => 'in:D2D,D2P,P2D,P2P',
            'transportationMode' => 'in:darat,laut',
            'shipmentType' => 'in:FCL,LCL',
            'pickupDate' => 'nullable|date',
            'departureDate' => 'nullable|date',
            'cyClosingDate' => 'nullable|date',
            'etd' => 'nullable|date',
            'eta' => 'nullable|date',
            'deliveryDate' => 'nullable|date',
            'arrivalDate' => 'nullable|date',
            'maxWeight' => 'integer|min:0',
            'maxVolume' => 'integer|min:0',
            // 'remainingWeight' => 'nullable|integer|min:0',
            // 'remainingVolume' => 'nullable|integer|min:0',
            // 'cargoType' => 'nullable|string|max:255', // atau gunakan enum:General Cargo,...
            'status' => 'in:active,deactive',
            'price' => 'numeric|min:0',
            // 'is_for_lsp' => 'nullable|boolean',
            // 'is_for_customer' => 'nullable|boolean',
            'container_id' => 'exists:containers,id',
            'truck_first_id' => 'exists:trucks,id',
            'truck_second_id' => 'exists:trucks,id',
        ]);

        // Cari offer berdasarkan ID
        $offer = offersModel::findOrFail($id);
        // $category = Category::where('name', $request['commodities'])->first();
        // // dd($attributes['commodities'], $category);
        // $cargoType = $category->type ?? null;
        $arrivalDate = $request['shipmentMode'] === 'D2P' ? $request['eta'] : $request['arrivalDate'];
        if (empty($attributes['etd']) &&
            $attributes['transportationMode'] === 'darat' &&
            $attributes['shipmentMode'] === 'D2D') {
            $attributes['etd'] = $attributes['departureDate'];
        }
        // Update data
        $offer->update([
            // // 'noOffer' => $request->noOffer,
            // // 'origin' => $request->origin,
            // // 'destination' => $request->destination,
            // 'shipmentMode' => $request->shipmentMode,
            // 'shipmentType' => $request->shipmentType,
            // // 'maxWeight' => $request->maxWeight,
            // // 'maxVolume' => $request->maxVolume,
            // 'commodities' => $request->commodities,
            // 'price' => $request->price,
            // // 'truck_id' => $request['truck_id'],
            // 'truck_first_id' => $request['truck_first_id'],
            // 'truck_second_id' => $request['truck_second_id'],
            // 'container_id' => $request['container_id'],
            // 'status' => $request->status,
            // 'cargoType' => $cargoType,
            'noOffer' => $request['noOffer'],
            'origin' => $request['origin'],
            'destination' => $request['destination'],
            'portOrigin' => $request['portOrigin'],
            'portDestination' => $request['portDestination'],
            'shipmentMode' => $request['shipmentMode'],
            'transportationMode' => $request['transportationMode'],
            'shipmentType' => $request['shipmentType'],
            'pickupDate' => $request['pickupDate'],
            'departureDate' => $request['departureDate'],
            'cyClosingDate' => $request['cyClosingDate'],
            'etd' => $request['etd'],
            'eta' => $request['eta'],
            'deliveryDate' => $request['deliveryDate'],
            'arrivalDate' => $arrivalDate,
            'maxWeight' => $request['maxWeight'],
            'maxVolume' => $request['maxVolume'],
            // 'remainingWeight' => $request['remainingWeight'],
            // 'remainingVolume' => $request['remainingVolume'],
            // 'cargoType' => $request['cargoType'],
            'status' => $request['status'],
            'price' => $request['price'],
            // 'is_for_lsp' => $request->has('is_for_lsp') ? 1 : 0,
            // 'is_for_customer' => $request->has('is_for_customer') ? 1 : 0,
            'container_id' => $request['container_id'],
            'truck_first_id' => $request['truck_first_id'],
            'truck_second_id' => $request['truck_second_id'],

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
