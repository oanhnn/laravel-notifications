<?php

namespace Laravel\Notifications\Listeners;

use Illuminate\Notificationss\Events\NotificationsSending;

class FilteringNotifications
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Notificationss\Events\NotificationsSending  $event
     * @return bool
     */
    public function handle(NotificationsSending $event): bool
    {
        app();
    }
}
