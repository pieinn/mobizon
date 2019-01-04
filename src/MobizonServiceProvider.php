<?php

namespace Laraketai\Mobizon;

use Mobizon\MobizonApi;
use Illuminate\Support\ServiceProvider;

class MobizonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/mobizon.php' => config_path('mobizon.php')
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Mobizon::class, function () {
            $config = config('mobizon');
            return new Mobizon($config['secret']);
        });
        $this->app->singleton(MobizonApi::class, function () {
            $config = config('mobizon');
            return new MobizonApi($config['secret']);
        });
    }
}
