<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::with('user')
            ->where('user_id', Auth::id())
            ->get();
        return view('pages.lsp.truck.index', compact('trucks'));
    }

    public function create()
    {
        return view('pages.lsp.truck.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'brand' => 'required|string',
            'type' => 'required|string',
            'color' => 'nullable|string',
            'yearBuilt' => 'required|integer',
            'plateNumber' => 'required|string|unique:trucks',
            'driverName' => 'required|string',
            'driverContact' => 'required|string',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png'
            // 'user_id' => 'required|exists:users,id'
        ]);
        $truck = new Truck();
        $truck->user_id = Auth::id();  // Mendapatkan user ID dari pengguna yang login
        $truck->plateNumber = $request->plateNumber;
        $truck->type = $request->type;
        $truck->brand = $request->brand;
        $truck->yearBuilt = $request->yearBuilt;
        $truck->driverName = $request->driverName;
        $truck->driverContact = $request->driverContact;
        $truck->color = $request->color;

    if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension(); // jpg / png
        $filename = Str::slug($request->plateNumber) . '-' . time() . '.' . $extension;

        // Simpan file manual ke storage/app/public/truck
        $file->storeAs('public/truck', $filename);

        // Simpan nama file ke database
        $truck->picture = 'truck/' . $filename;
    }

        $truck->save();

        // Truck::create($request->all());

        return redirect()->route('trucks.index')->with('success', 'Truk berhasil ditambahkan!');
    }

    public function edit(Truck $truck)
    {
        return view('pages.lsp.truck.edit', compact('truck'));
    }

    public function update(Request $request, Truck $truck)
    {
        // dd($request->all());
        $request->validate([
            'brand' => 'required|string',
            'type' => 'required|string',
            'color' => 'nullable|string',
            'yearBuilt' => 'required|integer',
            'plateNumber' => 'required|string|unique:trucks,plateNumber,' . $truck->id,
            'driverName' => 'required|string',
            'driverContact' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

    // Update manual semua field
    $truck->brand = $request->brand;
    $truck->type = $request->type;
    $truck->color = $request->color;
    $truck->yearBuilt = $request->yearBuilt;
    $truck->plateNumber = $request->plateNumber;
    $truck->driverName = $request->driverName;
    $truck->driverContact = $request->driverContact;
    $truck->user_id = $request->user_id;

    if ($request->hasFile('picture')) {
        $profilePath = $request->file('picture')->store('truck', 'public');
        $truck->picture = $profilePath;
    }

    $truck->save();

        return redirect()->route('trucks.index')->with('success', 'Truk berhasil diperbarui!');
    }

    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('trucks.index')->with('success', 'Truk berhasil dihapus!');
    }
}
