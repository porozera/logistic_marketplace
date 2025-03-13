<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index() {
        $containers = Container::all();
        return view('pages.admin.containers.container', ['containers' => $containers]);
    } 

    public function add() {
        return view('pages.admin.containers.container-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'code' => 'required|unique:containers|max:255',
            'name' => 'required|max:255',
            'weight' => 'required|numeric',
            'volume' => 'required|numeric',
            'description' => 'required'
        ]);

        $container = Container::create($request->all());
        return redirect('container')->with('success', 'Data Kontainer berhasil ditambahkan!');
    }

    public function edit($id) {
        $container = Container::findOrFail($id);
        return view('pages.admin.containers.container-edit', compact('container'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:containers,code,'.$id,
            'name' => 'required|max:255',
            'weight' => 'required|numeric',
            'volume' => 'required|numeric',
            'description' => 'required'
        ]);
    
        $container = Container::findOrFail($id);
        $container->update($request->all());
    
        return redirect('container')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $container = Container::findOrFail($id);
        $container->delete();

        return redirect('/container')->with('success', 'Data Kontainer berhasil dihapus');
    }

    
}
