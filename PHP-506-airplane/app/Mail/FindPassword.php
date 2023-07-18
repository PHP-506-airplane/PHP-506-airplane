<?php

namespace App\Mail;

use App\Models\Userinfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FindPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $tempPw;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Userinfo $user, $tempPw)
    {
        $this->user = $user;
        $this->tempPw = $tempPw;
    }

    // /**
    //  * Get the message envelope.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Envelope
    //  */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Find Password',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {
    //     return [];
    // }

    public function build()
    {
        return $this->view('email.resetPw')
                    ->with('user', $this->user)
                    ->with('tempPw', $this->tempPw)
                    ->subject('임시 비밀번호 안내');
    }
}
