<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('manage-user', function($user){
            if(!$user->hasRole(['superuser'])) {
                throw new AuthorizationException('Anda tidak diijinkan mengakses fitur ini ...');
            }
            return true;
        });
        Gate::define('manage-departement', function($user){
            if(!$user->hasRole(['superuser'])) {
                throw new AuthorizationException('Anda tidak diijinkan mengakses fitur ini ...');
            }
            return true;
        });
        Gate::define('manage-unit', function($user){
            if(!$user->hasRole(['superuser'])) {
                throw new AuthorizationException('Anda tidak diijinkan mengakses fitur ini ...');
            }
            return true;
        });
        Gate::define('manage-item', function($user){
            return $user->hasRole(['superuser', 'admin']);
        });
        Gate::define('manage-customer', function($user){
            return $user->hasRole(['superuser', 'admin']);
        });

    }
}
