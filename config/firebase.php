<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Firebase Service Account Credentials
    |--------------------------------------------------------------------------
    |
    | The path to your Firebase service account JSON file.
    |
    */

    'credentials' => env('FIREBASE_CREDENTIALS', base_path('storage/firebase.json')),

    /*
    |--------------------------------------------------------------------------
    | Firebase Database URL
    |--------------------------------------------------------------------------
    |
    | The Firebase Realtime Database URL.
    |
    */

    'database_url' => env('FIREBASE_DATABASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Default Firebase Project
    |--------------------------------------------------------------------------
    |
    | If you have multiple Firebase projects, you can specify the default one.
    |
    */

    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
    |--------------------------------------------------------------------------
    | Firebase Services
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific Firebase services.
    |
    */

    'services' => [
        'auth' => true,
        'database' => true,
        'firestore' => true,
        'storage' => true,
        'messaging' => true,
    ],
];
