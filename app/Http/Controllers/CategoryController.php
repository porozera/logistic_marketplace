<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('pages.admin.categories.category', ['categories' => $categories]);
    } 

    public function add() {
        return view('pages.admin.categories.category-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'code' => 'required|unique:categories|max:255',
            'name' => 'required|max:255',
            'type' => 'required',
            'description' => 'required'
        ]);

        $categories = Category::create($request->all());
        return redirect('category')->with('success', 'Data Layanan berhasil ditambahkan!');
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('pages.admin.categories.category-edit', compact('category'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'code' => 'required|unique:categories|max:255',
            'name' => 'required|max:255',
            'type' => 'required',
            'description' => 'required'
        ]);
    
        $category = Category::findOrFail($id);
        $category->update($request->all());
    
        return redirect('category')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $service = Category::findOrFail($id);
        $service->delete();

        return redirect('/service')->with('success', 'Data kategori barang berhasil dihapus');
    }
}
