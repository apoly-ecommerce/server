<?php

/*
|--------------------------------------------------------------------------
| System configs
|--------------------------------------------------------------------------
|
| The application needs this config file to run properly.
| Don't change any value is you're not sure about it.
|
*/

return [
    /*
    |--------------------------------------------------------------------------
    | Subscription settings
    |--------------------------------------------------------------------------
    |
    | This value will be determined to know if your business uses Subscription model or not
    |
    */
    'subscription' => [
        'enabled' => env('SUBSCRIPTION_ENABLED', true),
    ]
];