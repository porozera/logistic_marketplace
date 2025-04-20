<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectedAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $companyName;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($approval)
    {
        $this->companyName = $approval->companyName;
        $this->email = $approval->email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Anda Telah Ditolak',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.admin.approval.reject-email',
            with: [
                'companyName' => $this->companyName,  // Nama perusahaan
                'email' => $this->email,  // Email yang didaftarkan
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
