<?php

return [

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('cfc805618c34e8e2a31e'),
            'secret' => env('618749bfc1d1c8726fb5'),
            'app_id' => env('1968762'),
            'options' => [
                'cluster' => env('mt1'),
                'encrypted' => true,
            ],
        ],
    ],

];
