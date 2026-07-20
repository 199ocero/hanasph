<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOnboarded
{
    /**
     * Redirect authenticated users who haven't completed onboarding to the
     * onboarding flow before they can reach the core loop.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user !== null && ! $user->hasOnboarded()) {
            return redirect()->route('onboarding.show');
        }

        return $next($request);
    }
}
