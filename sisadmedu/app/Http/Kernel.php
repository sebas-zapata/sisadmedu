<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

// Middleware globales
use App\Http\Middleware\TrustProxies;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use App\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

// Middleware del grupo web
use App\Http\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Http\Middleware\PreventBackHistory;

// Middleware individuales
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Middleware\SetCacheHeaders;

class Kernel extends HttpKernel
{
    /**
     * Middleware global para todas las solicitudes.
     */
    protected $middleware = [
        HandlePrecognitiveRequests::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        TrustProxies::class,
    ];

    /**
     * Middleware agrupados por tipo (web, api).
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,

            // 👇 Middleware personalizado para prevenir navegación hacia atrás
            PreventBackHistory::class,
        ],

        'api' => [
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware que se pueden aplicar directamente a rutas específicas.
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'guest' => RedirectIfAuthenticated::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'can' => Authorize::class,
        'verified' => EnsureEmailIsVerified::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'cache.headers' => SetCacheHeaders::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ];
}
