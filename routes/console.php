<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\FetchNews;
use App\Console\Commands\GenerateDailyNews;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('news:fetch', function () {
    $this->call(FetchNews::class);
})->twiceDaily(0, 7); // Запуск в 00:00 и 07:00

Artisan::command('news:generate', function () {
    $this->call(GenerateDailyNews::class);
});
