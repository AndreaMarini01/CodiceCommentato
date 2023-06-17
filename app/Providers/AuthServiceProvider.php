<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Utiliziamo i middleware nelle routes e nelle viste
        //Definizione dei Gates per l'accesso autorizzato

        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('isUser', function ($user) {
            return $user->hasRole('user');
        });

        Gate::define('isStaff', function ($user) {
            return $user->hasRole('staff');
        });

        Gate::define('isUserOrisStaff', function ($user) {
            return $user->hasRole(['user', 'staff']);
        });

        Gate::define('show-discount', function ($user) {
            return $user->hasRole(['user', 'admin']);
        });
    }
}
