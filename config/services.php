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
    
    'google' => [
        
        'client_id' => '446937380544-oc3nnkcq4nj5vgur1l4812g9qbpg5s8s.apps.googleusercontent.com',
        'project_id' => 'loginauth-354710',
        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri' => 'https://oauth2.googleapis.com/token',
        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/success',
    ],
    
    'linkedin' => [
        
        'client_id' => '86yvyc1t4ux7mh',
        'client_secret' => 'Hma1uEmuYNPuRpvd',
        'redirect' => 'http://localhost:8000/successlinkdin',
    ],

];
