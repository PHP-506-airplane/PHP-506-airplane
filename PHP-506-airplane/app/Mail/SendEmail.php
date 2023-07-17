<?php

namespace App\Mail;

use App\Models\EmailVerify;
use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $emailVerify;

    /**
     * Create a new message instance.
     */
    public function __construct(Userinfo $user, EmailVerify $emailVerify)
    {
        $this->user = $user;
        $this->emailVerify = $emailVerify;
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Email',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $emailVerify = $this->emailVerify;
        return $this->view('email.regist')
            ->with('user', $user)
            ->with('emailVerify', $emailVerify)
            ->subject('이메일 인증을 완료해주세요.');
    }
}
