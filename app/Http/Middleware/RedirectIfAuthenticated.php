<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        \Illuminate\Support\Facades\Log::info('RedirectIfAuthenticated middleware triggered for guards: ' . implode(', ', $guards));
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            \Illuminate\Support\Facades\Log::info("Checking guard: " . ($guard ?? 'default'));
            if (Auth::guard($guard)->check()) {
                \Illuminate\Support\Facades\Log::info("User is authenticated with guard: " . ($guard ?? 'default') . ". Redirecting.");
                if ($guard === 'superadmin') {
                    return redirect('/admin/dashboard');
                }
                return redirect('/dashboard');
            }
            \Illuminate\Support\Facades\Log::info("User is not authenticated with guard: " . ($guard ?? 'default'));
        }

        \Illuminate\Support\Facades\Log::info('Proceeding with request.');
        return $next($request);
    }
}