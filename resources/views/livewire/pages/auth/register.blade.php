<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="zap" class="w-7 h-7 text-white"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">LeadsCheck</span>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Create your account</h2>
            <p class="text-gray-600">Start managing your leads more effectively</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white py-8 px-6 shadow-sm rounded-xl border border-gray-200">
            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Full name
                    </label>
                    <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Enter your full name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email address
                    </label>
                    <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Enter your email address">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Create a password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm password
                    </label>
                    <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                           placeholder="Confirm your password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Terms and Privacy -->
                <div class="text-xs text-gray-500">
                    By creating an account, you agree to our 
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Terms of Service</a> 
                    and 
                    <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Privacy Policy</a>.
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Create account
                    </button>
                </div>
            </form>
        </div>

        <!-- Benefits -->
        <div class="bg-white py-6 px-6 shadow-sm rounded-xl border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">What you'll get:</h3>
            <div class="space-y-3">
                <div class="flex items-center text-sm text-gray-600">
                    <i data-lucide="check" class="w-4 h-4 text-green-500 mr-3 flex-shrink-0"></i>
                    <span>Free forever plan with 100 leads/month</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i data-lucide="check" class="w-4 h-4 text-green-500 mr-3 flex-shrink-0"></i>
                    <span>Multi-channel lead capture</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i data-lucide="check" class="w-4 h-4 text-green-500 mr-3 flex-shrink-0"></i>
                    <span>Automated follow-up reminders</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i data-lucide="check" class="w-4 h-4 text-green-500 mr-3 flex-shrink-0"></i>
                    <span>Basic analytics and reporting</span>
                </div>
            </div>
        </div>

        <!-- Links -->
        <div class="text-center space-y-4">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" wire:navigate class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
            
            <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-1"></i>
                Back to home
            </a>
        </div>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</div>
