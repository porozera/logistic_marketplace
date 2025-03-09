<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class ContainerController extends Controller
{
    public function index() {
        $containers = Container::all();
        return view('admin.container', ['containers' => $containers]);
    } 

    public function add() {
        return view('admin.container-add');
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
        return redirect('kontainer');
    }
}
