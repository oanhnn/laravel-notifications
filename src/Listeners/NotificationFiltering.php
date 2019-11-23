<?php

namespace Laravel\Notifications\Listeners;

use Illuminate\Notifications\Events\NotificationSending;

class NotificationFiltering
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Notifications\Events\NotificationSending  $event
     * @return bool|null
     */
    public function handle(NotificationSending $event): ?bool
    {
        if (method_exists($event->notifiable, 'shouldReceive')) {
            return $event->notifiable->shouldReceive(get_class($event->notification), $event->channel);
        }
    }
}
