<?php

namespace App\Providers;

use Foundation\Models\User;
use App\Foundation\Enums\Role;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
           if ($user->hasRole(Role::ROLE_SUPER_ADMIN->value, Role::ROLE_ADMIN->value)) {
               return true;
           }
           return false;
        });
    }
}
