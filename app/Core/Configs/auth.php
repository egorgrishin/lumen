<?php

return [
    'defaults' => [
        'guard'     => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver'   => 'jwt',
            'provider' => 'user',
        ],
    ],

    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model'  => \Sections\User\User\Models\User::class,
        ]
    ]
];
