<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        view()->composer(config('app.theme'), function ($view) {
            $view->with('theme', str_replace('master', '', config('app.theme')));
        });

        Paginator::defaultView('pagination::default');
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
