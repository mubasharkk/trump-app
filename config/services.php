<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', '6b5acb546eebd8473602'),         // Your GitHub Client ID
        'client_secret' => env('GITHUB_CLIENT_SECRET', '49466342e9d0a89a924b4f3670411bbb1438cc6d'), // Your GitHub Client Secret
        'redirect' => 'http://dashboard.empatica.dev/login/github/callback',
    ],

    'twitter' => [
        'consumer_key' => 'U9XTGDqrDmGFjmywUenxKl0I1',
        'consumer_secret' => 'XdfeSIeUl60D5SL4KDNeGY6b41kadVxWLUsK8LmFpo9MZD2vrf',
    ]
];
