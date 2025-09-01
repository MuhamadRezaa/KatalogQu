<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'checkout/simulate-payment',
        'checkout/callback',
        'test-post',
        'simulate-payment',
        'auth/google/*',
        'midtrans/notification',
        'api/midtrans/notification',
        'api/midtrans/get-snap-token',
        'api/midtrans/test-snap-token',
        'midtrans/test',
    ];
}
