<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google OAuth Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Google OAuth integration with additional settings
    | for handling SSL verification in development environments.
    |
    */

    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect_uri' => env('GOOGLE_REDIRECT_URI', env('APP_URL', 'http://localhost:8000') . '/auth/google/callback'),

    /*
    |--------------------------------------------------------------------------
    | SSL Verification Settings
    |--------------------------------------------------------------------------
    |
    | These settings help handle SSL certificate issues in development
    | environments like Laragon, XAMPP, etc.
    |
    */

    'ssl_verify' => env('CURL_SSL_VERIFYPEER', env('APP_ENV') === 'production'),

    /*
    |--------------------------------------------------------------------------
    | OAuth Scopes
    |--------------------------------------------------------------------------
    |
    | Define the OAuth scopes that should be requested from Google
    |
    */

    'scopes' => [
        'openid',
        'profile',
        'email'
    ],

    /*
    |--------------------------------------------------------------------------
    | OAuth Options
    |--------------------------------------------------------------------------
    |
    | Additional options for the OAuth flow
    |
    */

    'options' => [
        'prompt' => 'select_account',
        'access_type' => 'offline',
    ],
];
