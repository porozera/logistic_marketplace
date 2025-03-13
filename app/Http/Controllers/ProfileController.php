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
}
