<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
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
        setlocale(LC_TIME, 'fra', 'fr_FR', 'fr_FR.utf8');
        view()->composer(config('app.theme'), function ($view) {
            $view->with('theme', str_replace('master', '', config('app.theme')));
        });

        Paginator::defaultView('pagination::default');

        User::observe(UserObserver::class);
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
