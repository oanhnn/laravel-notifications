<?php

namespace Laravel\Notifications;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package     Laravel\Notifications
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // register config
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/notifications.php', 'notifications');

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeHandler::class,
            ]);
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $pkg = dirname(__DIR__);

        // publish vendor resources
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [$pkg . '/config/notifications.php' => base_path('config/notifications.php')],
                'laravel-notifications-config'
            );
            $this->publishes(
                [$pkg . '/stubs/handler.stub' => resource_path('stubs/handler.stub')],
                'laravel-notifications-stubs'
            );
        }
    }
}
