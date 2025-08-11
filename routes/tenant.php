<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::view('/', 'welcome');

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    Route::get('roles', \App\Livewire\RoleManager::class)
        ->middleware(['auth', 'feature:feature_roles'])
        ->name('roles.index');

    Route::get('users', \App\Livewire\UserManager::class)
        ->middleware(['auth', 'feature:feature_user_management'])
        ->name('users.index');

    Route::get('/impersonate/{token}', function ($token) {
        return \Stancl\Tenancy\Features\UserImpersonation::makeResponse($token);
    })->name('tenant.impersonate');

    // Add the missing impersonation leave route
    Route::get('/impersonate/leave', function () {
        return \Stancl\Tenancy\Features\UserImpersonation::makeResponse(null);
    })->name('impersonation.leave');

    Route::middleware(['auth', 'feature:feature_lead_management'])->group(function () {
        Route::get('leads', \App\Livewire\LeadList::class)->name('leads.index');
        Route::get('leads/create', \App\Livewire\LeadForm::class)->name('leads.create');
        Route::get('leads/{lead}/edit', \App\Livewire\LeadForm::class)->name('leads.edit');
    });

    Route::get('statuses', \App\Livewire\StatusManager::class)
        ->middleware(['auth', 'feature:feature_dynamic_statuses'])
        ->name('statuses.index');

    Route::get('form-fields', \App\Livewire\FormFieldManager::class)
        ->middleware(['auth', 'feature:feature_dynamic_forms'])
        ->name('form-fields.index');

    require __DIR__.'/auth.php';
});
