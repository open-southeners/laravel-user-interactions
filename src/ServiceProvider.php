<?php

namespace OpenSoutheners\LaravelUserInteractions;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use OpenSoutheners\LaravelUserInteractions\Support\Interaction;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../config/user-interactions.php' => config_path('user-interactions.php'),
            ], 'config');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('user.interaction', fn () => new Interaction());
    }
}
