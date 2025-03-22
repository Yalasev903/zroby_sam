<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\SendAutoGreeting;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendAutoGreeting::class,
        ],
        // інші події...
    ];

    public function boot(): void
    {
        //
    }
}
