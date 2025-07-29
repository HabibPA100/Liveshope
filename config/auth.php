<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'buyer' => [ // ✅ নতুন buyer guard
            'driver' => 'session',
            'provider' => 'buyers',
        ],
        'seller' => [ // ✅ নতুন seller guard
            'driver' => 'session',
            'provider' => 'sellers',
        ],
        'admin' => [ // ✅ নতুন admin guard
            'driver' => 'session',
            'provider' => 'admin_user',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'buyers' => [ // ✅ নতুন buyers provider
            'driver' => 'eloquent',
            'model' => App\Models\Buyer::class,
        ],
        'sellers' => [ // ✅ নতুন seller provider
            'driver' => 'eloquent',
            'model' => App\Models\Seller::class,
        ],
        'admin_user' => [ // ✅ নতুন admin provider
            'driver' => 'eloquent',
            'model' => App\Models\AdminUser::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        // ✅ Add this 👇
        'buyers' => [
            'provider' => 'buyers',
            'table' => 'buyer_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'sellers' => [
            'provider' => 'sellers',
            'table' => 'seller_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admin_user',
            'table' => 'admin_password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
