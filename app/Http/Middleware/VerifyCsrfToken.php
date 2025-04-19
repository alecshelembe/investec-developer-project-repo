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
        'authenticate', // Add this to disable CSRF for the route
        'fetchAccountInfo', // Add this to disable CSRF for the route
        'location',  // Exclude this route from CSRF protection
        'fetchAccountBalance', // Add this to disable CSRF for the route
    ];
}
