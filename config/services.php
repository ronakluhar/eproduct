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

    'facebook' => [
        'client_id' => '1899859370300984',
        'client_secret' => '23eba8bce940bb70602181a360c61f6d',
        'redirect' => 'http://ec2-54-235-230-178.compute-1.amazonaws.com:81/facebook/callback'
    ],

    'google' => [
        'client_id' => '772792986701-1a4fdd41r91h2615skashvlfer3ee060.apps.googleusercontent.com',
        'client_secret' => 'iNnqFe4LprKdA9-u0eRJoruC',
        'redirect' => 'http://ec2-54-235-230-178.compute-1.amazonaws.com:81/google/callback'
    ],

];
