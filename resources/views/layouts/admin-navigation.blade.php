<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center h-16">
                <a href="{{ route('admin.dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col space-y-1">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <br>
                <x-nav-link :href="route('admin.tenants.index')" :active="request()->routeIs('admin.tenants.index')">
                    {{ __('Tenants') }}
                </x-nav-link>
                <x-nav-link :href="route('admin.custom-fields.index')" :active="request()->routeIs('admin.custom-fields.index')">
                    {{ __('Custom Fields') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>