<?php

namespace App\Modules\Recurringinvoices\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'recurringinvoices');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'recurringinvoices');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'recurringinvoices');
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
