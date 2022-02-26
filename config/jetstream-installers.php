<?php
// config for HeaderX/JetstreamInstallers
return [
    'lab404-impersonate' => [
        'enabled' => env('LAB404_IMPERSONATE', false),
        'middleware' => [
            'web',
            'auth:sanctum',
            // 'can:impersonate',
        ],
        'route_prefix' => 'lab404-impersonate',
    ],
];
