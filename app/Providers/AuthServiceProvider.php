<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
         $this->registerPolicies();
         
        Gate::define('admin', function () {

            return auth()->user()->role == 1;

        });

        Gate::define('access', function(string $data) {
            // Retrieve the user's permissions from the database
            $userPermissions = auth()->user()->access;
            $permissions = explode(',', $userPermissions);

            return in_array($data, $permissions) || in_array('*', $permissions);
        });

    }
}
