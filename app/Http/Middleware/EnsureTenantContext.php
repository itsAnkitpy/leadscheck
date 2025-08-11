<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EnsureTenantContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Log the current state to verify tenant context is properly initialized
        Log::info('EnsureTenantContext - Database connection: ' . config('database.default'));
        Log::info('EnsureTenantContext - Auth guard: ' . config('auth.defaults.guard'));

        // Verify we're in tenant context
        if (config('database.default') !== 'tenant') {
            Log::warning('EnsureTenantContext - Not in tenant context, database: ' . config('database.default'));
            return redirect()->route('login');
        }

        // If user is authenticated, ensure they're using the correct tenant context
        if (Auth::check()) {
            $user = Auth::user();
            $tenantUserId = session('tenant_user_id');
            $tenantId = session('tenant_id');
            
            Log::info('EnsureTenantContext - Authenticated user: ' . $user->name . ' (ID: ' . $user->id . ')');
            Log::info('EnsureTenantContext - Session tenant_user_id: ' . $tenantUserId . ', tenant_id: ' . $tenantId);
            
            // If session doesn't have tenant context or user ID doesn't match, logout
            if (!$tenantUserId || $user->id != $tenantUserId) {
                Log::warning('EnsureTenantContext - User context mismatch, logging out');
                Auth::logout();
                session()->forget(['tenant_user_id', 'tenant_user_name', 'tenant_user_email', 'tenant_id']);
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
