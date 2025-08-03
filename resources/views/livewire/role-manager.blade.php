<div>
    <div class="p-4">
        <h2 class="text-lg font-medium text-gray-900">Create Role</h2>
        <form wire:submit.prevent="createRole">
            <div class="mt-4">
                <label for="name" class="block font-medium text-sm text-gray-700">Role Name</label>
                <input id="name" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" wire:model.defer="name" />
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700">Permissions</label>
                @foreach($permissions as $permission)
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" value="{{ $permission->name }}" wire:model.defer="selectedPermissions">
                            <span class="ml-2">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Role
                </button>
            </div>
        </form>
    </div>

    <div class="p-4">
        <h2 class="text-lg font-medium text-gray-900">Roles</h2>
        <table class="min-w-full divide-y divide-gray-200 mt-4">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Permissions
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($roles as $role)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $role->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach($role->permissions as $permission)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="deleteRole({{ $role->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
