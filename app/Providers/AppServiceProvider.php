<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('role_admin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('role_guru', function ($user) {
            return $user->role == 'guru';
        });

        Gate::define('role_sekertaris', function ($user) {
            return $user->role == 'sekertaris';
        });

        Gate::define('role_osis', function ($user) {
            return $user->role == 'osis';
        });
    }
}
