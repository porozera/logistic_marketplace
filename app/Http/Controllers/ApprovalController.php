<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\SendingEmail;
use App\Models\RequestUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ApprovedAccountMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApprovalController extends Controller
{
    public function index() {
        $approvals = RequestUser::all();
        $approvals = RequestUser::all()->map(function ($item) {
            $item->badgeClass = match($item->status) {
                'Telah di Approve' => 'bg-light-success',
                'Ditolak' => 'bg-light-danger',
                'Butuh di Approve' => 'bg-light-warning',
            };
            return $item;
        });
        
        return view('pages.admin.approval.approval', ['approvals' => $approvals]);
    } 

    public function show($id) {
        $approval = RequestUser::findOrFail($id);
        return view('pages.admin.approval.approval-detail', compact('approval'));
    }

//     public function approve($id)
// {
//     $requestUser = RequestUser::findOrFail($id);

//     // Generate random password
//     $plainPassword = Str::random(10);
//     $hashedPassword = Hash::make($plainPassword);

//     // Kirim email
//     Mail::to($requestUser->email)->send(new ApproveAccountMail(
//         $requestUser->email,
//         $plainPassword,
//         'Akun Anda telah disetujui oleh Admin.'
//     ));

//     // Ubah status
//     $requestUser->status = 'Sudah di Approve';
//     $requestUser->save();

//     // Masukkan data ke tabel users
//     User::create([
//         'username' => explode('@', $requestUser->email)[0],
//         'email' => $requestUser->email,
//         'password' => $hashedPassword,
//         'firstName' => '',
//         'lastName' => '',
//         'role' => 'lsp',
//         'telpNumber' => $requestUser->telpNumber,
//         'profilePicture' => null,
//         'description' => null,
//         'rating' => null,
//         'address' => $requestUser->address,
//         'companyName' => $requestUser->companyName,
//         'bannerPicture' => null,
//         'accountNumber' => null,
//         'accountName' => null,
//         'permitNumber' => $requestUser->permitNumber,
//     ]);

//     return redirect()->back()->with('success', 'Akun berhasil di-approve dan email dikirim.');
// }

    public function sendApproveEmail(Request $request) {
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
        $approval->status = 'Telah di Approve';
        $approval->save();

        // Kirim email
        Mail::to($approval->email)->send(new ApprovedAccountMail($approval, $generatedPassword));

        return redirect()->route('admin.approval-lsp')->with('success', 'Akun berhasil di-approve, email dan password telah dikirim.');
    }












    public function showForm() {
        return view('pages.admin.approval.sendingEmail');
    }
    public function sendEmail(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        Mail::to($request->email)->send(new SendingEmail([
            'pesan' => $request->pesan
        ]));

        return back()->with('success', 'Email berhasil dikirim!');
    }
}
