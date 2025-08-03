<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Services\FeatureService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function update(Request $request, Tenant $tenant)
    {
        $tenant->features()->sync($request->input('features', []));

        FeatureService::clearCache($tenant->id);

        return redirect()->route('admin.tenants.edit', $tenant)->with('success', 'Features updated successfully.');
    }
    public function index()
    {
        return view('admin.tenants.index');
    }

    public function create()
    {
        return view('admin.tenants.create');
    }

    public function edit(Tenant $tenant)
    {
        return view('admin.tenants.edit', compact('tenant'));
    }

    public function impersonate(Tenant $tenant)
    {
        $user = $tenant->run(fn () => \App\Models\User::first());

        if (!$user) {
            return redirect()->back()->with('error', 'No user found for this tenant.');
        }

        $token = tenancy()->impersonate($tenant, $user->id, redirect()->route('admin.dashboard'))->token;

        return redirect('http://' . $tenant->domains->first()->domain . '/impersonate/' . $token);
    }

    public function leaveImpersonation()
    {
        if (!session()->has('impersonator_id')) {
            return redirect()->route('admin.dashboard');
        }
        
        tenancy()->endImpersonation();

        return redirect()->route('admin.tenants.index');
    }
}
