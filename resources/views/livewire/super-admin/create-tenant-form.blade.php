<div class="space-y-6">
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="createTenant" class="space-y-4">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Tenant Name</label>
                <input type="text" id="name" wire:model.defer="name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('name') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="domain" class="block text-sm font-medium text-gray-700">Domain</label>
                <input type="text" id="domain" wire:model.defer="domain" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('domain') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="plan" class="block text-sm font-medium text-gray-700">Plan</label>
            <select id="plan" wire:model.defer="plan" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="enterprise">Enterprise</option>
            </select>
            @error('plan') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>
        
        <hr class="my-6">

        <h4 class="text-lg font-medium text-gray-900">Tenant Admin User</h4>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label for="admin_name" class="block text-sm font-medium text-gray-700">Admin Name</label>
                <input type="text" id="admin_name" wire:model.defer="admin_name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('admin_name') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="admin_email" class="block text-sm font-medium text-gray-700">Admin Email</label>
                <input type="email" id="admin_email" wire:model.defer="admin_email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('admin_email') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="admin_password" class="block text-sm font-medium text-gray-700">Admin Password</label>
            <input type="password" id="admin_password" wire:model.defer="admin_password" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('admin_password') <span class="mt-2 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create Tenant
            </button>
        </div>
    </form>
</div>
