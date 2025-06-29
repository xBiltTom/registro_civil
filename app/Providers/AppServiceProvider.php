<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Acta;
use App\Models\ActaDefuncion;
use App\Models\Persona;
use App\Policies\ActaDefuncionPolicy;
use App\Policies\UserPolicy;
use App\Policies\ActaPolicy;
use App\Policies\PersonaPolicy;

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
        Gate::before(function($user,$ability){
            return $user->hasRole('admin') ? true : null;
        });

        Gate::policy(User::class,UserPolicy::class);
        Gate::policy(Acta::class,ActaPolicy::class);
        Gate::policy(ActaDefuncion::class,ActaDefuncionPolicy::class);
        Gate::policy(Persona::class,PersonaPolicy::class);
    }
}
