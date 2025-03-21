<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileCustomerController extends Controller
{
    public function index() {
        $user = User::where('id',Auth::id())->first();
        return view('pages.customer.profile.index', compact('user'));
    } 

    public function edit() {
        $user = User::where('id',Auth::id())->first();
        return view('pages.customer.profile.edit', compact('user'));
    } 

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'telpNumber' => 'nullable|string|max:20',
            'profilePicture' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'address' => 'nullable|string',
            'companyName' => 'nullable|string',
            'bannerPicture' => 'nullable|string',
            'accountName' => 'nullable|string',
            'accountNumber' => 'nullable|string|max:30',
        ]);

        $user = User::findOrFail(Auth::id());

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'telpNumber' => $request->telpNumber,
            'profilePicture' => $request->profilePicture,
            'description' => $request->description,
            'rating' => $request->rating,
            'address' => $request->address,
            'companyName' => $request->companyName,
            'bannerPicture' => $request->bannerPicture,
            'accountName' => $request->accountName,
            'accountNumber' => $request->accountNumber,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('profile-customer')->with('success', 'Profil berhasil diperbarui!');
    }
}
