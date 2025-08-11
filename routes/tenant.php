<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
*/

Route::middleware([
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
    \Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class,
    \App\Http\Middleware\EnsureTenantContext::class,
    'web',
])->group(function () {
    Route::get('/', function () {
        return 'This is your tenant application.';
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/impersonate/{token}', function ($token) {
        return \Stancl\Tenancy\Features\UserImpersonation::makeResponse($token);
    })->name('tenant.impersonate');

    // Add the missing impersonation leave route
    Route::get('/impersonate/leave', function () {
        return \Stancl\Tenancy\Features\UserImpersonation::makeResponse(null);
    })->name('impersonation.leave');

    require __DIR__.'/auth.php';
});
