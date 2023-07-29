<?php

namespace ShibuyaKosuke\LaravelValuedomainApi\Providers;

use Illuminate\Support\ServiceProvider as ServiceProviderBase;
use ShibuyaKosuke\LaravelValuedomainApi\ValueDomain;

class ServiceProvider extends ServiceProviderBase
{
    public const KEY = 'valuedomain';

    /**
     * @return void
     */
    public function boot(): void
    {
        // Publish config files
        $this->publishes([
            __DIR__ . '/../../config/valuedomain.php' => config_path('valuedomain.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../../config/valuedomain.php', self::KEY);

        $this->app->bind($this::class, function ($app) {
            return new ValueDomain($app->config);
        });
    }
}
