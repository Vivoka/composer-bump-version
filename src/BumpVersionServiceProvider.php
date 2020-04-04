<?php

namespace Vivoka\BumpVersion;

use Illuminate\Support\ServiceProvider;

class BumpVersionServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/config.php',
            'ComposerBump'
        );


        $this->publishes([
            __DIR__ . '/config.php' => config_path('composerbump.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('ComposerBump', \Vivoka\BumpVersion\ComposerBump::class);

        $this->registerBumpVersionGenerator();

        $this->registerUndoBump();
    }


    private function registerBumpVersionGenerator()
    {
        $this->app->singleton('bump.bump.version', function ($app) {
            return $app['Vivoka\BumpVersion\Commands\BumpVersionCommand'];
        });

        $this->commands('bump.bump.version');
    }

    private function registerUndoBump()
    {
        $this->app->singleton('bump.bump.undo', function ($app) {
            return $app['Vivoka\BumpVersion\Commands\UndoBumpCommand'];
        });

        $this->commands('bump.bump.undo');
    }
}
