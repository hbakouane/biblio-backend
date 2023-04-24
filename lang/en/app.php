<?php

return [
    'response' => [
        'success' => 'Operation was completed successfully.',
        'failure' => 'Something went wrong.',
        'invalid' => 'Invalid response from server.'
    ],

    'auth' => [
        'register' => [
            'success' => 'User was registered successfully.'
        ],

        'login' => [
            'success' => 'User was logged in successfully.',
            'failure' => 'The given credentials are wrong.'
        ]
    ],

    'mail' => [
        'welcome' => [
            'welcome' => 'Welcome to ' . config('app.name') . ', :name!',
            'content' => '<b>Hi :name</b>, <br /><br /> We\'ve got great news, your new account has been activated. You can visit our online library and start buying your favourite books!'
        ],
        'discover_books' => 'Discover our books'
    ]
];