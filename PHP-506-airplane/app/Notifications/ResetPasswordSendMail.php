<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordSendMail extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     * 
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $nofitiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     * 
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        $link = url("/password/reset/?token=".$this->token);
        return (new MailMessage)
                    ->view('emailpassword', ['token' => $this->token]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $nofitiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

//패스워드 찾기 메일 폼 수정
//패스워드 메일 보낼 때 지정된 블레이드 파일의 형식으로 보내기
}
