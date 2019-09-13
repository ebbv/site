<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
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
        if (request()->segment(1) === 'en') {
            setlocale(LC_TIME, 'en');

            app()->setLocale('en');

            config(['user_prefered_locale' => 'en']);
        } else {
            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

            Route::resourceVerbs([
                'create' => 'créer',
                'edit'   => 'modifier'
            ]);
        }

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
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
