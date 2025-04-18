<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Mail\ComplainAnswerMail;
use Illuminate\Support\Facades\Mail;

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
    
    
}
