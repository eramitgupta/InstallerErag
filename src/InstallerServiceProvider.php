<?php

namespace InstallerErag;

use Illuminate\Support\ServiceProvider;
use InstallerErag\Middleware\InstallMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use InstallerErag\Components\error;
use InstallerErag\Components\Input;
use InstallerErag\Components\Select;

class InstallerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('InstallerErag\Controllers\InstallerController');
        $this->app->make('InstallerErag\Controllers\DatabaseConyroller');
        $this->loadViewsFrom(__DIR__ . '/Views', 'InstallerEragViews');
    }

    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        include __DIR__ . '/routes.php';

        $router->middlewareGroup('installCheck', [InstallMiddleware::class]);

        Blade::component('input', Input::class);
        Blade::component('error', error::class);
        Blade::component('select', Select::class);

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/InstallerEragViews'),
        ], 'InstallerErag');

        $this->publishes([
            __DIR__.'/Assets' => public_path('install'),
        ], 'InstallerErag');

        $this->publishes([
            __DIR__.'/Config/install.php' => base_path('config/install.php'),
        ], 'InstallerErag');

    }
}
