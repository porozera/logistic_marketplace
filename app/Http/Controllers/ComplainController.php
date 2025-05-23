<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Complain;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\ComplainAnswerMail;
use Illuminate\Support\Facades\Auth;
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
    
     // Kirim notifikasi ke admin
    //  $admins = User::where('role', 'admin')->get(); // asumsi role = 'admin'
    
     Notification::create([
        'sender_id' => 1,
        'receiver_id' => 1,
        'header' => 'Komplain Baru Diterima',
        'description' => "Komplain dari {$request->username} telah diterima dan menunggu peninjauan.",
        'is_read' => false,
    ]);
    

    return back()->with('success', 'Pesan Anda telah dikirim! Kami akan segera menanggapi.');
    }   

    public function index_customer() {
        $complains = Complain::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('pages.customer.complains.index', compact('complains'));
    } 

    public function create() {
        $user = Auth::user();
        return view('pages.customer.complains.create', compact('user'));
    }

    public function store(Request $request) {
        $attributes = $request->validate([
            'description' => 'required',
            'email' => 'required|email',
            'user_id' => 'required',
        ]);
        $complain = Complain::create([
            'description' => $attributes['description'],
            'email' => $attributes['email'],
            'user_id' => $attributes['user_id'],
            'username' => Auth::user()->username,
            'status' => 'Pending',
        ]);

        return redirect()->route('complain-customer')->with('success', 'Complain submitted successfully.');
    }

    public function detail_customer($id) {
        $complain = Complain::findOrFail($id);
        return view('pages.customer.complains.detail', compact('complain'));
    }
}
