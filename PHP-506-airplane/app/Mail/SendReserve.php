<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Userinfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReserve extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $reserveData;

    /**
     * Create a new message instance.
     *
     * @param Userinfo $user
     */
    public function __construct(Userinfo $user, Collection $reserveData)
    {
        $this->user = $user;
        $this->reserveData = $reserveData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $reserveData = $this->reserveData->first();

        return $this->view('email.reserve', compact('user', 'reserveData'))
            ->subject($user->u_name . '님, 예약하신 항공편입니다.');
    }
}
