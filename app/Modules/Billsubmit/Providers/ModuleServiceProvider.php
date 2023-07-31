<?php

namespace App\Modules\Billsubmit\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'billsubmit');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'billsubmit');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'billsubmit');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
