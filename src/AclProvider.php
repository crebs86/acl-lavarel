<?php

namespace Crebs86\Acl;

use Crebs86\Acl\Controllers\Util\ControlAccess;
use Illuminate\Support\ServiceProvider;

class AclProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Route/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views/views', 'crebs');
        $this->loadTranslationsFrom(__DIR__.'/Views/lang', 'crebs');
        /**
         * ----------------------------------------------------
         * php artisan vendor:publish --tag=second --force
         * ----------------------------------------------------
         */
        $this->publishes([
            __DIR__ . '/Publish/User.php' =>   base_path().'/app/User.php',
        ], 'second');
        $this->publishes([
            __DIR__ . '/Publish/Providers/AuthServiceProvider.php' => base_path().'/app/Providers/AuthServiceProvider.php'
        ], 'second');
        /**
         * ----------------------------------------------------
         * php artisan vendor:publish --tag=first --force
         * ----------------------------------------------------
         */
        $this->publishes([
            __DIR__ . '/Publish/Public' => public_path('/vendor/crebs86/acl-laravel'),
        ], 'first');
        $this->publishes([
            __DIR__.'/Publish/Views/errors' => resource_path('/views/errors')
        ], 'first');
        /**
         * ----------------------------------------------------
         * php artisan vendor:publish --tag=first --force
         * ----------------------------------------------------
         */
        $this->publishes([
            __DIR__.'/Publish/Database/migrations' =>   database_path('/migrations')
        ], 'first');
        $this->publishes([
            __DIR__.'/Publish/Database/seeds' =>   database_path('/seeds')
        ], 'first');
        $this->publishes([
            __DIR__.'/Publish/Config/config.php' => config_path('cre_acl.php')
        ], 'first');

    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('acl', function (){
            return new ControlAccess();
        });
    }
}
