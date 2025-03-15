<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {
        $cities = City::all();
        return view('pages.admin.cities.city', ['cities' => $cities]);
    } 

    public function add() {
        $provinces = Province::all(); // Ambil semua data provinsi
        return view('pages.admin.cities.city-add', compact('provinces'));
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'id_province' => 'required|exists:provinces,id', // Validasi harus ada di tabel provinces
            'name' => 'required|max:255',
            'postalCode' => 'required|max:255'
        ]);

        City::create($validated);
        return redirect('city')->with('success', 'Data Kota berhasil ditambahkan!');
    }

    public function edit($id) {
        $city = City::findOrFail($id);
        $provinces = Province::all(); // Ambil semua data provinsi
        return view('pages.admin.cities.city-edit', compact('city', 'provinces'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'id_province' => 'required|exists:provinces,id', // Validasi harus ada di tabel provinces
            'name' => 'required|max:255',
            'postalCode' => 'required|max:255'
        ]);
    
        $city = City::findOrFail($id);
        $city->update($validated);
    
        return redirect('city')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect('/city')->with('success', 'Data Kota berhasil dihapus');
    }
}
