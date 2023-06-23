<?php

return [
    'bucket' => env('SUPPORT_BUCKET', 'weiliusupport'),
    'env' => app()->environment(),
    'http' => [
        'timeout' => 10.0,
    ],
    'log' => [
        'default' => 'daily',
        'channels' => [
            'daily' => [
                'name' => 'Support-SDK',
                'driver' => 'daily',
                'path' => app()->basePath('storage/logs/support_sdk.log'),
                'level' => config('app.debug')
                    ? 'debug'
                    : 'info',
                'days' => 7,
            ],
        ],
    ],
];