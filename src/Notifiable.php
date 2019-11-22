<?php

namespace Laravel\Notifications;

use Illuminate\Notifications\Notifiable as IlluminateNotifiable;

trait Notifiable
{
    use IlluminateNotifiable;

    protected function routeNotificationForDatabase()
    {

    }
}
