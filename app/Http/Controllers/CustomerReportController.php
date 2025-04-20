<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    public function index() {
        $customers = User::select('id', 'username', 'email', 'telpNumber', 'role')
                    ->where('role', 'customer')
                    ->get();

        return view('pages.admin.customers.customer', compact('customers'));
    }

    public function edit($id) {
        $customer = User::findOrFail($id);
        return view('pages.admin.customers.customer-edit', compact('customer'));
    }

    public function update(Request $request, $id) {
        $customer = User::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('profilePicture')) {
            $data['profilePicture'] = $request->file('profilePicture')->store('images', 'public');
        }
        if ($request->hasFile('bannerPicture')) {
            $data['bannerPicture'] = $request->file('bannerPicture')->store('images', 'public');
        }    

        $customer->update($data);

        return redirect()->route('admin.customer.index')->with('success', 'Data Customer berhasil diperbarui');
    }

    public function show($id) {
        $customer = User::findOrFail($id);
        return view('pages.admin.customers.customer-detail', compact('customer'));
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success', 'Data berhasil dihapus.');
    }

}
