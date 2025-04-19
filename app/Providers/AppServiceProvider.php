<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        DB::statement('PRAGMA foreign_keys = ON;');

         View::composer('*', function ($view) {
            $title = $view->getData()['title'] ?? 'Zroby_Sam | Інноваційна платформа для майстрів та замовників';
            $description = $view->getData()['description'] ?? 'Інноваційна платформа для майстрів та замовників: профілі, портфоліо, чат, оголошення, замовлення.';

            $view->with(compact('title', 'description'));
        });
    }
}
