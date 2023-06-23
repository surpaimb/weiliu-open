<?php

return [
    'appkey' => env('WORKPHONE_APPKEY'),
    'appsecret' => env('WORKPHONE_APPSECRET'),
    'env' => app()->environment(),
    'http' => [
        'timeout' => 10.0,
    ],
    'log' => [
        'default' => 'daily',
        'channels' => [
            'daily' => [
                'name' => 'WorkPhone-SDK',
                'driver' => 'daily',
                'path' => app()->basePath('storage/logs/workphone_sdk.log'),
                'level' => config('app.debug')
                    ? 'debug'
                    : 'info',
                'days' => 7,
            ],
        ],
    ],
];