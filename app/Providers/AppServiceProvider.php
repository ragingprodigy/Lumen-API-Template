<?php

namespace DevProject\Providers;

use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package DevProject\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RedisServiceProvider::class);
        $this->app->register(LumenServiceProvider::class);
    }
}
