<?php

namespace App\Mail;

use App\Models\FlightInfo;
use App\Models\Userinfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendEmailDelay extends Mailable
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
        Log::debug('메일 __construct : ', [$data, $reason]);
        $this->flightInfo = $data;
        $this->reason = $reason;
        Log::debug('메일 __construct 이후 : ', [$this->flightInfo, $this->reason]);
    }
    
    public function build() {
        Log::debug('메일 build : ', [$this->flightInfo]);
        return $this->view('email.resDelay')
            ->subject($this->flightInfo['u_name'] . '님, 예약하신 항공편의 지연 안내입니다.')
            ->with('data', $this->flightInfo)
            ->with('reason', $this->reason);
    }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {

    // }

}
