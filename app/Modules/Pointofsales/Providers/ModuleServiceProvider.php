<?php

namespace App\Modules\Pointofsales\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'pointofsales');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'pointofsales');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'pointofsales');
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
