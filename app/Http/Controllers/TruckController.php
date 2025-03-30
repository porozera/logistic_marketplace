<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all();
        return view('pages.lsp.truck.index', compact('trucks'));
    }

    public function create()
    {
        return view('pages.lsp.truck.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'type' => 'required|string',
            'color' => 'nullable|string',
            'yearBuilt' => 'required|integer',
            'plateNumber' => 'required|string|unique:trucks',
            'driverName' => 'required|string',
            'driverContact' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        Truck::create($request->all());

        return redirect()->route('trucks.index')->with('success', 'Truk berhasil ditambahkan!');
    }

    public function edit(Truck $truck)
    {
        return view('pages.lsp.truck.edit', compact('truck'));
    }

    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'brand' => 'required|string',
            'type' => 'required|string',
            'color' => 'nullable|string',
            'yearBuilt' => 'required|integer',
            'plateNumber' => 'required|string|unique:trucks,plateNumber,' . $truck->id,
            'driverName' => 'required|string',
            'driverContact' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ]);

        $truck->update($request->all());

        return redirect()->route('trucks.index')->with('success', 'Truk berhasil diperbarui!');
    }

    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('trucks.index')->with('success', 'Truk berhasil dihapus!');
    }
}
