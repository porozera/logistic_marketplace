<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Mail\ComplainAnswerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
{
    public function index() {
        $complains = Complain::all();
        return view('pages.admin.complains.complain', ['complains' => $complains]);
    } 
    
    public function detail($id) {
        $complain = Complain::findOrFail($id);
        return view('pages.admin.complains.complain-detail', ['complain' => $complain]);
    }

    public function sendAnswer(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string',
            'pesan' => 'required|string',
            'complain_id' => 'required|exists:complains,id' // pastikan valid
        ]);
    
        // Kirim email
        Mail::to($request->email)->send(new ComplainAnswerMail(
            $request->username,
            $request->pesan
        ));
    
        // Update status jadi "Solved"
        $complain = Complain::findOrFail($request->complain_id);
        $complain->status = 'Solved';
        $complain->save();
    
        // Redirect kembali dengan sweetalert notification
        return redirect()->route('admin.complain.index')->with('success', 'Email tanggapan berhasil dikirim!');
    }

    public function show() {
        // $complains = Complain::all();
        return view('landing-contact');
    } 

    public function storeComplain(Request $request) {
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255',
        'email' => 'required|email',
        'pesan' => 'required|string|min:10',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput()->with('error', 'Mohon periksa kembali isian Anda.');
    }

    Complain::create([
        'username' => $request->username,
        'email' => $request->email,
        'description' => $request->pesan,
        'status' => 'Pending',
    ]);

    return back()->with('success', 'Pesan Anda telah dikirim! Kami akan segera menanggapi.');
    
    }
}
