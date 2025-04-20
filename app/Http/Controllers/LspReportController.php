<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LspReportController extends Controller
{
   
    public function index() {
        $lsps = User::select('id', 'companyName', 'email', 'permitNumber', 'rating')
                    ->where('role', 'lsp')
                    ->get();

        return view('pages.admin.lsp.lsp', compact('lsps'));
    }

    public function edit($id) {
        $lsp = User::findOrFail($id);
        return view('pages.admin.lsp.lsp-edit', compact('lsp'));
    }

    public function update(Request $request, $id) {
        $lsp = User::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('profilePicture')) {
            $data['profilePicture'] = $request->file('profilePicture')->store('images', 'public');
        }
        if ($request->hasFile('bannerPicture')) {
            $data['bannerPicture'] = $request->file('bannerPicture')->store('images', 'public');
        }    

        $lsp->update($data);

        return redirect()->route('admin.lsp.index')->with('success', 'Data LSP berhasil diperbarui');
    }

    public function show($id) {
        $lsp = User::findOrFail($id);
        return view('pages.admin.lsp.lsp-detail', compact('lsp'));
    }

    public function destroy($id)
    {
        $lsp = User::findOrFail($id);
        $lsp->delete();

        return redirect()->route('admin.lsp.index')->with('success', 'Data berhasil dihapus.');
    }

}
