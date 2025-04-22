<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RequestUser;
use App\Models\Notification;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create_customer()
    {
        return view('auth.register_customer');
    }

    public function create_lsp()
    {
        return view('auth.register_lsp');
    }


    public function store_customer(Request $request)
    {
        try {
            $attributes = $request->validate([
                'username' => 'required|max:255|min:2',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:5|max:255',
                'firstName' => 'required',
                'lastName' => 'required',
                'telpNumber' => 'required',
                'address' => 'required',
                'role' => 'required',
                'terms' => 'required',
            ]);
    
            $data = User::create([
                'username' => $attributes['username'],
                'email' => $attributes['email'],
                'password' => bcrypt($attributes['password']),
                'firstName' => $attributes['firstName'],
                'lastName' => $attributes['lastName'],
                'telpNumber' => $attributes['telpNumber'],
                'address' => $attributes['address'],
                'role' => $attributes['role'],
            ]);
    
            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }    

    public function store_lsp(Request $request)
    {
        try {
            $attributes = $request->validate([
                'companyName' => 'required',
                'permitNumber' => 'required',
                'email' => 'required',
                'address' => 'required',
                'telpNumber' => 'required',
                'terms' => 'required',
            ]);
    
            $data = RequestUser::create([
                'companyName' => $attributes['companyName'],
                'permitNumber' => $attributes['permitNumber'],
                'email' => $attributes['email'],
                'telpNumber' => $attributes['telpNumber'],
                'address' => $attributes['address'],
                'status' => "Butuh di Approve",
            ]);
            // Notifikasi ke semua admin
            // $admins = User::where('role', 'admin')->get();

            Notification::create([
                'sender_id' => 1,
                'receiver_id' => 1,
                'header' => 'Pendaftaran LSP Baru',
                'description' => "Permintaan pendaftaran dari perusahaan {$request->companyName} telah diterima dan menunggu peninjauan.",
                'is_read' => false,
            ]);
            
    
            return redirect('/login')->with('success', 'Registrasi berhasil! Tunggu sesaat untuk mendapatkan email dari Admin.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withErrors(['permitNumber' => 'Nomor izin sudah terdaftar.'])->withInput();
            }
    
            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.'])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }    
}
