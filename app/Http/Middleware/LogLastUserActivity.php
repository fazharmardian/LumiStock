<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Store the user's last activity in the cache
            $expiresAt = now()->addMinutes(5); // Consider the user offline after 5 mins
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
        }

        return $next($request);
    }
}