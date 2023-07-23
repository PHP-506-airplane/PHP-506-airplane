<?php

namespace App\Jobs;

use App\Mail\ResCancel;
use App\Models\FlightInfo;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailCancel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $user;
    protected $del_reason;

    /**
     * Create a new job instance.
     *
     * @param object $user
     * @param string $del_reason
     * @return void
     */
    public function __construct($user, $del_reason)
    {
        // Log::debug('큐 도착');
        $this->user = $user;
        $this->del_reason = $del_reason;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Log::debug('큐 handle');
        Mail::to($this->user->u_email)->send(new ResCancel($this->user, $this->del_reason));
    }
}
