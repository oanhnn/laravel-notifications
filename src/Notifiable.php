<?php

namespace Laravel\Notifications;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable as IlluminateNotifiable;
use Laravel\Notifications\Models\NotificationSetting;

trait Notifiable
{
    use IlluminateNotifiable;

    /**
     * Define a polymorphic one-to-many relationship.
     *
     * @param  string  $related
     * @param  string  $name
     * @param  string  $type
     * @param  string  $id
     * @param  string  $localKey
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function morphMany($related, $name, $type = null, $id = null, $localKey = null): MorphMany;

    /**
     * Get all notification types with settings
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notificationSettings(): MorphMany
    {
        return $this
            ->morphMany(
                NotificationSetting::class,
                'notifiable',
            );
    }

    /**
     * Check should receive the given notification type via the given channel
     *
     * @param  string $type
     * @param  string $channel
     * @return bool
     */
    public function shouldReceive(string $type, string $channel): bool
    {
        $setting = $this->notificationSettings()
            ->where('type', $type)
            ->first();

        if (!is_null($setting) && isset($setting->channels[$channel])) {
            return $setting->channels[$channel];
        }

        return config('notifications.defaults')[$channel] ?? false;
    }

    /**
     * Update notification setting for the given type
     *
     * @param string $type
     * @param array  $channels
     * @return void
     */
    public function updateNotificationSetting(string $type, array $channels = [])
    {
        $setting = $this->notificationSettings()
            ->where('type', $type)
            ->firstOrNew();

        $setting->fill(['channels' => $channels])->saveOrFail();
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    protected function routeNotificationForDatabase(): MorphMany
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
