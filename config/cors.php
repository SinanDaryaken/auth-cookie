<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', '*'], // Include all routes or adjust as needed
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'https://cleture-test-auth.vercel.app',
        'http://cleture-test-auth.vercel.app',
        'http://frontend.home:8000',
        'https://frontend.home:8000',
        'https://auth.cleture.com',
        'http://auth.cleture.com',
    ],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Important for cookies
];
