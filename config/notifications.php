<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default notification settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify which settings will be used for default notification settings.
    |
    */
    'defaults' => [
        'email' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Base Handler Class
    |--------------------------------------------------------------------------
    |
    | Here you may specify which class will be used as the base class
    | for all generated handlers.
    |
    | Default is `\Laravel\Handlers\Handler::class` , but it only work with Laravel.
    | Alternative value is `\App\Http\Controllers\Controller::class` (work with both Laravel and Lumen)
    */
    'base' => \Laravel\Handlers\Handler::class,
];
