<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Message' => 'App\Policies\MessagePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-member', function ($user) {
            return \App\Models\Member::has('admin')->find($user->id);
        });

        Gate::define('update-member', function ($user, $id) {
            if (\App\Models\Member::has('admin')->find($user->id) or $user->id == $id) {
                return true;
            }

            return false;
        });
    }
}
