<?php

namespace App\Modules\Serialentry\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'serialentry');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'serialentry');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'serialentry');
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
