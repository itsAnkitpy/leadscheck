<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Get the current domain from the request
        $domain = request()->getHost();
        
        // Find the tenant by domain
        $tenant = \App\Models\Tenant::whereHas('domains', function($query) use ($domain) {
            $query->where('domain', $domain);
        })->first();

        if (!$tenant) {
            throw ValidationException::withMessages([
                'form.email' => 'Tenant not found for domain: ' . $domain,
            ]);
        }

        // Run authentication in tenant context
        $success = $tenant->run(function () use ($tenant) {
            // Ensure we're using the tenant database for authentication
            config(['database.default' => 'tenant']);
            
            $result = Auth::attempt($this->only(['email', 'password']), $this->remember);
            
            if ($result) {
                // Get the authenticated user from tenant context
                $user = Auth::user();
                
                // Log the authenticated user
                \Illuminate\Support\Facades\Log::info('Authentication successful in tenant context - User: ' . $user->name . ' (ID: ' . $user->id . ')');
                
                // Store user data in session for proper context
                session()->put('tenant_user_id', $user->id);
                session()->put('tenant_user_name', $user->name);
                session()->put('tenant_user_email', $user->email);
                session()->put('tenant_id', $tenant->id);
                
                // Regenerate session to ensure clean state
                session()->regenerate();
            } else {
                \Illuminate\Support\Facades\Log::info('Authentication failed in tenant context');
            }
            
            return $result;
        });

        if (!$success) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
