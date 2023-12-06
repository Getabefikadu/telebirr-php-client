<?php

return [
    'options' => [
        'url' => env('URL', null),
        'public_key' => env('PUBLIC_KEY', null),
        'app_id' => env('APP_ID', null),
        'app_key' => env('APP_KEY', null),
        'short_code' => env('SHORT_CODE', null),
        'receive_name' => env('RECEIVE_NAME', null),
        'timeout_express' => env('TIMEOUT_EXPRESS', null),
        'notify_url' => env('NOTIFY_URL', null),
    ]
];
