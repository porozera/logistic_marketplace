<?php

namespace App\Mail;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovedAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;
    public $email;
    public $password;


    // private $pesan = "";

    /**
     * Create a new message instance.
     */
    public function __construct($approval,$password)
    {
        // $this->pesan = $pesan['pesan'];
        // Ambil data dari model RequestUser
        $this->companyName = $approval->companyName;
        $this->email = $approval->email;
        $this->password = $password;// 8 karakter password acak
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Anda Telah Disetujui',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.admin.approval.approve-email',
            with: [
                'companyName' => $this->companyName,  // Nama perusahaan
                'email' => $this->email,  // Email yang didaftarkan
                'password' => $this->password,  // Password yang digenerate
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
