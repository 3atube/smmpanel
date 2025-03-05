<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook'  => [
        'client_id'                 => '703545863870465',
        'client_secret'             => '23a15c27a8a4507d6600605dd16f2abd',
        'redirect'                  => 'https://toolv3.com/auth/facebook/callback',
        // 'permission'             => ['email']
    ],
    'google' => [
        'client_id' => '975316311512-6ij1m2jjj0kk2l1v0l09rl5qpgeakuhf.apps.googleusercontent.com',
        'client_secret' => 'AiNbwP9CUb6IPB3vz0HPwip-',
        'redirect' => 'https://toolv3.com/auth/google/callback',
    ],

];
