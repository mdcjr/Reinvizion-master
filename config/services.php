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
        'region' => env('SES_REGION'),
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    // 'facebook' => [
    //     'client_id' => '1361692437213968',
    //     'client_secret' => '2452480c6c4a92eea376f840d24edf05',
    //     'redirect' => 'http://localhost:8000/auth/facebook/callback',
    // ],
    'facebook' => [
        'client_id' => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect' => env('FB_REDIRECT'),
    ],

    // 'google' => [
    //     'client_id' => '1038503819433-m3nmkk0js3hq8o3n5pqvtca2dtefpo18.apps.googleusercontent.com',
    //     'client_secret' => '5Q2-zlW2v0JmCeoR97Mv9DDx',
    //     'redirect' => 'http://localhost:8000/callback/google',
    // ],
    'sendinblue' => [
       'url' => 'https://api.sendinblue.com/v2.0',
       'key' => env('SENDINBLUE_KEY'),
    ],

];
