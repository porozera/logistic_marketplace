<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index() {
        $provinces = Province::all();
        return view('pages.admin.provinces.province', ['provinces' => $provinces]);
    } 

    public function add() {
        return view('pages.admin.provinces.province-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|max:255',
            'postalCode' => 'required|unique:provinces|max:255'
        ]);

        $province = Province::create($request->all());
        return redirect('/admin/province')->with('success', 'Data Layanan berhasil ditambahkan!');
    }

    public function edit($id) {
        $province = Province::findOrFail($id);
        return view('pages.admin.provinces.province-edit', compact('province'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'postalCode' => 'required|unique:provinces|max:255'
        ]);
    
        $province = Province::findOrFail($id);
        $province->update($request->all());
    
        return redirect('/admin/province')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $province = Province::findOrFail($id);
        $province->delete();

        return redirect('/admin/province')->with('success', 'Data Layanan berhasil dihapus');
    }
}
