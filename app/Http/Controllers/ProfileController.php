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

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'description' => 'nullable|string',
            'profilePicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bannerPicture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profilePicture')) {
            $profilePicturePath = $request->file('profilePicture')->store('profile_pictures', 'public');
            $user->profilePicture = $profilePicturePath;
        }

        if ($request->hasFile('bannerPicture')) {
            $bannerPicturePath = $request->file('bannerPicture')->store('banner_pictures', 'public');
            $user->bannerPicture = $bannerPicturePath;
        }

        $user->description = $request->description;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
