<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        return view('pages.admin.services.service', ['services' => $services]);
    } 

    public function add() {
        return view('pages.admin.services.service-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'code' => 'required|unique:services|max:255',
            'serviceName' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        $service = Service::create($request->all());
        return redirect('service')->with('success', 'Data Layanan berhasil ditambahkan!');
    }

    public function edit($id) {
        $service = Service::findOrFail($id);
        return view('admin.service-edit', compact('service'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:services,code,'.$id,
            'serviceName' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);
    
        $service = Service::findOrFail($id);
        $service->update($request->all());
    
        return redirect('service')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect('/service')->with('success', 'Data Layanan berhasil dihapus');
    }
}
