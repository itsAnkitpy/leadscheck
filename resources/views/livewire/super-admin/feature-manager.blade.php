<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold">Features Management</h2>
            <button wire:click="$set('showCreateForm', true)" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                Add New Feature
            </button>
        </div>

        <!-- Create Feature Form -->
        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-medium mb-4">Create New Feature</h3>
            <form wire:submit.prevent="createFeature" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Feature Name</label>
                        <input wire:model="name" type="text" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="key" class="block text-sm font-medium text-gray-700">Feature Key</label>
                        <input wire:model="key" type="text" id="key" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="feature_key_name">
                        @error('key') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input wire:model="description" type="text" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                        Create Feature
                    </button>
                </div>
            </form>
        </div>

        <!-- Features List -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feature Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Key</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenants Using</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($features as $feature)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($editingFeatureId === $feature->id)
                                    <input wire:model="editingName" type="text" class="w-full border-gray-300 rounded-md shadow-sm">
                                @else
                                    <span class="font-medium text-gray-900">{{ $feature->name }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($editingFeatureId === $feature->id)
                                    <input wire:model="editingKey" type="text" class="w-full border-gray-300 rounded-md shadow-sm">
                                @else
                                    <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $feature->key }}</code>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($editingFeatureId === $feature->id)
                                    <input wire:model="editingDescription" type="text" class="w-full border-gray-300 rounded-md shadow-sm">
                                @else
                                    <span class="text-gray-600">{{ $feature->description ?? 'No description' }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $feature->tenants()->count() }} tenants
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if ($editingFeatureId === $feature->id)
                                    <button wire:click="updateFeature" class="text-green-600 hover:text-green-900 mr-2">Save</button>
                                    <button wire:click="cancelEdit" class="text-gray-600 hover:text-gray-900">Cancel</button>
                                @else
                                    <button wire:click="editFeature({{ $feature->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                                    <button wire:click="deleteFeature({{ $feature->id }})" 
                                            wire:confirm="Are you sure you want to delete this feature? This action cannot be undone."
                                            class="text-red-600 hover:text-red-900">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No features found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
