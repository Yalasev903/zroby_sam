<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('🔒 Відновлення пароля | Zroby_Sam')
            ->greeting('Привіт!')
            ->line('Ми отримали запит на відновлення вашого пароля.')
            ->action('Скинути пароль', $resetUrl)
            ->line('Це посилання дійсне протягом 60 хвилин.')
            ->line('Якщо ви не надсилали запит, просто проігноруйте цей лист.')
            ->salutation('З повагою, команда Zroby_Sam 👷');
    }
}
