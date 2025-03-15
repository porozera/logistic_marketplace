<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user(); // Mendapatkan data user yang sedang login
    //     return view('lsp.profile', compact('user'));
    // }

    public function index(Request $request)
    {
        $user = $request->user(); // Mengambil user yang sedang login dari middleware auth
        return view('pages.lsp.profile.index', compact('user'));
    }
    public function edit(Request $request)
    {
        // Ambil data user dari middleware atau session
        $user = $request->user(); // jika middleware menyisipkan user ke request

        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('pages.lsp.profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'description' => 'nullable|string',
            'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bannerPicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update deskripsi
        $user->description = $request->description;

        // Upload dan simpan banner picture
        if ($request->hasFile('bannerPicture')) {
            $bannerPath = $request->file('bannerPicture')->store('banners', 'public');
            $user->bannerPicture = $bannerPath;
        }

        // Upload dan simpan profile picture
        if ($request->hasFile('profilePicture')) {
            $profilePath = $request->file('profilePicture')->store('profiles', 'public');
            $user->profilePicture = $profilePath;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
