<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {
        $cities = City::all();
        return view('pages.admin.cities.city', ['cities' => $cities]);
    } 

    public function add() {
        return view('pages.admin.cities.city-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'id_province' => 'required|numeric',
            'name' => 'required|max:255',
            'code' => 'required|max:255'
        ]);

        $city = City::create($request->all());
        return redirect('city')->with('success', 'Data Kota berhasil ditambahkan!');
    }
}
