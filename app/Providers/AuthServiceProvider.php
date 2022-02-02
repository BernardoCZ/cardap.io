<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate para o usuário do tipo empresa
        Gate::define('empresa', function ($user) {
            return $user->type == 'empresa'
                        ? Response::allow()
                        : Response::deny('Essa ação é autorizada apenas para contas empresariais');
        });

        //Gate para o usuário do tipo cliente
        Gate::define('cliente', function ($user) {
            return $user->type == 'cliente'
                        ? Response::allow()
                        : Response::deny('Essa ação é autorizada apenas para contas cliente');
        });
    }
}
