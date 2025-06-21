<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = 'https://FRONT_URL/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Сброс пароля')
            ->line('Вы получили это письмо, потому что был запрошен сброс пароля для вашей учётной записи.')
            ->action('Сбросить пароль', $url)
            ->line('Если вы не запрашивали сброс пароля, никаких действий предпринимать не нужно.');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
