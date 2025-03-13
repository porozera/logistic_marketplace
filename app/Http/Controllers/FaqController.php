<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::all();
        return view('pages.admin.faqs.faq', ['faqs' => $faqs]);
    } 

    public function add() {
        return view('pages.admin.faqs.faq-add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'type' => 'required',
            'header' => 'required|max:255',
            'description' => 'required'
        ]);

        $faqs = Faq::create($request->all());
        return redirect('faq')->with('success', 'Data Layanan berhasil ditambahkan!');
    }

    public function edit($id) {
        $faq = Faq::findOrFail($id);
        return view('pages.admin.faqs.faq-edit', compact('faq'));
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'type' => 'required',
            'header' => 'required|max:255',
            'description' => 'required'
        ]);
    
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
    
        return redirect('faq')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id) {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect('/faq')->with('success', 'Data berhasil dihapus');
    }
}
