<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DependencyInjectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * User dependency
         */
        $this->app->bind(
            \App\Modules\Authentication\User\Repositories\UserRepository::class,
            \App\Modules\Authentication\User\Repositories\EloquentUserRepository::class
        );

        /**
         * Permission dependency
         */
        $this->app->bind(
            \App\Modules\Authentication\Permission\Repositories\PermissionRepository::class,
            \App\Modules\Authentication\Permission\Repositories\EloquentPermissionRepository::class
        );

        /**
         * Role dependency
         */
        $this->app->bind(
            \App\Modules\Authentication\Role\Repositories\RoleRepository::class,
            \App\Modules\Authentication\Role\Repositories\EloquentRoleRepository::class
        );

    }
}
