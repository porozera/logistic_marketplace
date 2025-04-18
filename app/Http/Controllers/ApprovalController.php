<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendingEmail;
use App\Models\RequestUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ApprovedAccountMail;
use App\Mail\RejectedAccountMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationAccountMail;

class ApprovalController extends Controller
{
    public function index() {
        $approvals = RequestUser::all();
        $approvals = RequestUser::all()->map(function ($item) {
            $item->badgeClass = match($item->status) {
                'Approved' => 'bg-light-success',
                'Rejected' => 'bg-light-danger',
                'Requested' => 'bg-light-warning',
                'On Confirmation' => 'bg-light-primary',
            };
            return $item;
        });
        
        return view('pages.admin.approval.approval', ['approvals' => $approvals]);
    } 

    public function show($id) {
        $approval = RequestUser::findOrFail($id);
        return view('pages.admin.approval.approval-detail', compact('approval'));
    }

    public function sendApproveEmail(Request $request) {
        Log::info('🚀 sendConfirmationEmail terpanggil');

        $email = $request->input('email');
        $approvalId = $request->input('approval_id');

        if (!$email || !$approvalId) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak lengkap.');
        }

        $approval = RequestUser::find($approvalId);
        if (!$approval) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak ditemukan.');
        }

        // Generate password acak
        $generatedPassword = Str::random(8);
        
        // Simpan ke tabel users
        User::create([
            'username' => explode('@', $approval->email)[0], // contoh default username
            'email' => $approval->email,
            'password' => Hash::make($generatedPassword),
            'firstName' => '-', // Default kosong
            'lastName' => '-', // Default kosong
            'role' => 'lsp', // Atur role lsp
            'telpNumber' => $approval->telpNumber,
            'profilePicture' => null,
            'description' => null,
            'rating' => null,
            'address' => $approval->address,
            'companyName' => $approval->companyName,
            'bannerPicture' => null,
            'accountNumber' => null,
            'accountName' => null,
            'permitNumber' => $approval->permitNumber,
        ]);

        // Update status approval
        $approval->status = 'Approved';
        $approval->save();

        // Kirim email
        Mail::to($approval->email)->send(new ApprovedAccountMail($approval, $generatedPassword));

        return redirect()->route('admin.approval-lsp')->with('success', 'Akun berhasil di-approve, email dan password telah dikirim.');
    }

    public function sendRejectEmail(Request $request) {
        $email = $request->input('email');
        $approvalId = $request->input('approval_id');

        if (!$email || !$approvalId) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak lengkap.');
        }

        $approval = RequestUser::find($approvalId);
        if (!$approval) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak ditemukan.');
        }
        // Update status approval
        $approval->status = 'Rejected';
        $approval->save();

        // Kirim email
        Mail::to($approval->email)->send(new RejectedAccountMail($approval));

        return redirect()->route('admin.approval-lsp')->with('rejected', 'Akun telah ditolak dan notifikasi telah dikirim.');
    }

    public function sendConfirmationEmail(Request $request) {
        $email = $request->input('email');
        $approvalId = $request->input('approval_id');

        if (!$email || !$approvalId) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak lengkap.');
        }

        $approval = RequestUser::find($approvalId);
        if (!$approval) {
            return redirect()->route('admin.approval-lsp')->with('error', 'Data tidak ditemukan.');
        }
        // Update status approval
        $approval->status = 'On Confirmation';
        $approval->save();

        // Kirim email
        Mail::to($approval->email)->send(new ConfirmationAccountMail($approval));

        return redirect()->route('admin.approval-lsp')->with('success', 'Permintaan konfirmasi berhasil dikirim!');
    }

}
