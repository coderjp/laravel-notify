<?php namespace Coderjp\Notify;

/**
 * This file is part of Notify,
 *
 * @license MIT
 * @package Coderjp\Notify
 */

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('notify.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNotify();
        $this->mergeConfig();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerNotify()
    {
        $this->app->bind('notify', function ($app) {
            return new Notify($app);
        });
    }

    /**
     * Merges user's and notify's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'notify'
        );
    }
}
