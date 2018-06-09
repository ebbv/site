<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'fra', 'fr_FR', 'fr_FR.utf8');
        view()->composer(config('app.theme'), function ($view) {
            $view->with('theme', str_replace('master', '', config('app.theme')));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
