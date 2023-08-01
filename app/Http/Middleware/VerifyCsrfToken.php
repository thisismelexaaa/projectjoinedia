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
        //
<<<<<<< HEAD
<<<<<<< HEAD
        '/callback'
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
=======
        '/callback'
>>>>>>> 8019b8b (70% Progress)
    ];
}
