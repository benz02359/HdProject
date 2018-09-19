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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'firebase' => [
        'api_key' => 'AIzaSyDiaUDP4dhP_FUbTXOFa-g7ugATxi9lmdI', // Only used for JS integration
        'auth_domain' => 'hdpj-632ed.firebaseapp.com', // Only used for JS integration
        //'database_url' => 'https://database_url.com/',
        //'secret' => 'secret',
        'storage_bucket' => 'hdpj-632ed.appspot.com', // Only used for JS integration
        'database_url' => env('FB_DATABASE', 'https://hdpj-632ed.firebaseio.com/'),
        'secret' => env('FB_DATABASE_KEY', 'bvAb0W9VxOA3kfBsP0TjoO9ONTk9ni8q2J5QLH5C'),
    ]
];
