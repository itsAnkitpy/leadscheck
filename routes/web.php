<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Livewire\StatusManager;
use App\Livewire\SuperAdmin\CustomFieldManager;
use App\Livewire\FormFieldManager;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [SuperAdminLoginController::class, 'create'])->name('login')->middleware('guest:superadmin');
    Route::post('/login', [SuperAdminLoginController::class, 'store'])->name('login.store')->middleware('guest:superadmin');
    Route::post('/logout', [SuperAdminLoginController::class, 'destroy'])->name('logout')->middleware('auth:superadmin');

    Route::middleware('auth:superadmin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
        Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
        Route::get('/tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
        Route::post('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
        Route::get('/impersonate/tenant/{tenant}', [TenantController::class, 'impersonate'])->name('tenant.impersonation');
        Route::get('/impersonate/leave', [TenantController::class, 'leaveImpersonation'])->name('tenant.impersonation.leave');
        Route::get('/custom-fields', CustomFieldManager::class)->name('custom-fields.index');
        Route::get('/features', \App\Livewire\SuperAdmin\FeatureManager::class)->name('features.index');
    });
});

require __DIR__.'/auth.php';
