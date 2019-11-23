<?php

namespace Laravel\Notifications;

use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Notifications\Listeners\NotificationFiltering;

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
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        Event::listen(NotificationSending::class, NotificationFiltering::class);
    }

    /**
     * Bootstrap the application services in console mode
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        $pkg = dirname(__DIR__);

        // publish vendor resources
        $this->publishes(
            [$pkg . '/config/notifications.php' => base_path('config/notifications.php')],
            'laravel-notifications-config'
        );

        $this->publishes(
            [
                $pkg . '/database/migrations/create_notification_settings_table.stub'
                => database_path("migrations/2019_11_23_000000_create_notification_settings_table.php")
            ],
            'laravel-notifications-migrations'
        );
    }
}
