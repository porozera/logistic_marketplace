<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use App\Mail\ComplainAnswerMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
            'header' => 'required',
            'email' => 'required|email',
            'user_id' => 'required',
        ]);
        $complain = Complain::create([
            'description' => $attributes['description'],
            'header' => $attributes['header'],
            'email' => $attributes['email'],
            'user_id' => $attributes['user_id'],
            'is_answered' => false,
        ]);

        return redirect()->route('complain')->with('success', 'Complain submitted successfully.');
    }

    public function detail($id) {
        $complain = Complain::findOrFail($id);
        return view('pages.customer.complains.detail', compact('complain'));
    }
}
