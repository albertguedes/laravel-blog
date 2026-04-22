<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as BaseEnsureEmailIsVerified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

/**
 * Custom email verification middleware.
 *
 * Extends Laravel's base EnsureEmailIsVerified middleware to provide
 * custom redirect route for unverified users.
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 * @see BaseEnsureEmailIsVerified
 * @see MustVerifyEmail
 */
class EnsureEmailIsVerified extends BaseEnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * Checks if the user has verified their email address.
     * If not verified, redirects to the email verification resend page.
     *
     * @param  Request  $request
     * @param  string|null  $redirectToRoute
     * @return Response|RedirectResponse
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'verify-email.resend'));
        }

        return $next($request);
    }
}
