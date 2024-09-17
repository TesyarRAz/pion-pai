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

        Gate::define('role_guruspy', function ($user) {
            return $user->role == 'guruspy';
        });

        Gate::define('panel_guru', function($user) {
            return $user->role == 'guru' || $user->role == 'guruspy';
        });

        Gate::define('role_sekertaris', function ($user) {
            return $user->role == 'sekertaris';
        });

        Gate::define('role_siswaspy', function ($user) {
            return $user->role == 'siswaspy';
        });

        Gate::define('panel_siswa', function($user) {
            return $user->role == 'sekertaris' || $user->role == 'siswaspy';
        });

        Gate::define('role_osis', function ($user) {
            return $user->role == 'osis';
        });

        Gate::define('role_satpam', function ($user) {
            return $user->role == 'satpam';
        });
    }
}
