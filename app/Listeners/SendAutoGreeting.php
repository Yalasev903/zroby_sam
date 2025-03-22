<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\AdminSetting;
use App\Models\Notification;

class SendAutoGreeting
{
    /**
     * Обробка події реєстрації.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user; // Новый пользователь, зарегистрированный через Fortify/Jetstream

        // Получаем настройки админпанели (предполагаем, что всегда создан хотя бы один запись)
        $adminSetting = AdminSetting::first();

        if ($adminSetting && $adminSetting->auto_greeting_enabled) {
            $greetingText = $adminSetting->auto_greeting_text ?? 'Вітаємо у нашому сервісі!';

            // Создаем уведомление для нового пользователя
            Notification::create([
                'user_id' => $user->id,
                'title'   => 'Повідомлення від адміністратора',
                'message' => $greetingText,
                'read'    => false,
            ]);
        }
    }
}
