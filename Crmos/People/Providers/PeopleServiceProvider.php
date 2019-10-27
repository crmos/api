<?php

namespace Crmos\People\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Crmos\People\Contracts\User as UserContract;
use Crmos\People\Models\User;
use Crmos\People\Repositories\UserRepository;
use Crmos\People\Policies\UserPolicy;

class PeopleServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Boot the application events.
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->make('router')->aliasMiddleware('auth', \Crmos\People\Http\Middleware\AuthMiddleware::class);

        $this->app->make('router')->middleware(\Spatie\Cors\Cors::class);

        Relation::morphMap([
            'users' => User::class,
        ]);

        $this->registerPolicies();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        if (class_exists('Laravel\Passport\Passport'))
            \Laravel\Passport\Passport::ignoreMigrations();

        $this->app->bind(
            UserContract::class,
            UserRepository::class
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('people.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'people'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/people');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/people';
        }, \Config::get('view.paths')), [$sourcePath]), 'people');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/people');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'people');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'people');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
