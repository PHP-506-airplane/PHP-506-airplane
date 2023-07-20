<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $flightInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->flightInfo = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendReminder')
            ->subject($this->flightInfo->u_name . '님, 예약하신 항공편의 출발 3시간 전입니다.')
            ->with('data', $this->flightInfo);
    }
}
