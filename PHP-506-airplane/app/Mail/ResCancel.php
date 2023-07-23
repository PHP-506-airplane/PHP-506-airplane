<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResCancel extends Mailable
{
    use Queueable, SerializesModels;
    public $flightInfo;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $reason)
    {
        $this->flightInfo = $data;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->view('email.ResCancel')
            ->subject($this->flightInfo->u_name . '님, 예약하신 항공편의 결항 안내입니다.')
            ->with('data', $this->flightInfo)
            ->with('reason', $this->reason);
    }

    // /**
    //  * Get the message envelope.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Envelope
    //  */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Res Cancel',
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

}
