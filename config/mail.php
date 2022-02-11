<?php

return [


    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => env('MAIL_HOST', 'localhost'),

    'port' => env('MAIL_PORT', 25),

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'no-reply@meine.bewerbung.one'),
        'name' => env('MAIL_FROM_NAME', 'meine'),
    ],

    'encryption' => env('MAIL_ENCRYPTION', ''),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],


    'log_channel' => env('MAIL_LOG_CHANNEL'),


];
