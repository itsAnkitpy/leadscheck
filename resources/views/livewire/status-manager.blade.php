<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-bold mb-4">Manage Lead Statuses</h2>

        <!-- Create Status Form -->
        <form wire:submit.prevent="createStatus" class="mb-6">
            <div class="flex items-center space-x-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Status Name</label>
                    <input wire:model.defer="name" id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <input wire:model.defer="color" id="color" type="color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="pt-5">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create
                    </button>
                </div>
            </div>
        </form>

        <!-- Statuses List -->
        <h3 class="text-xl font-semibold mb-4">Existing Statuses</h3>
        <ul wire:sortable="updateStatusOrder" class="space-y-2">
            @foreach ($statuses as $status)
                <li wire:sortable.item="{{ $status->id }}" wire:key="status-{{ $status->id }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-md shadow-sm">
                    <div class="flex items-center space-x-3">
                        <span wire:sortable.handle class="cursor-move">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </span>
                        <span class="w-4 h-4 rounded-full" style="background-color: {{ $status->color }};"></span>
                        <span>
                            @if ($editingStatusId === $status->id)
                                <input wire:model.defer="editingStatusName" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <input wire:model.defer="editingStatusColor" type="color" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('editingStatusName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @else
                                {{ $status->name }}
                            @endif
                        </span>
                    </div>
                    <div>
                        @if ($editingStatusId === $status->id)
                            <button wire:click="updateStatus" class="text-green-600 hover:text-green-900">Save</button>
                            <button wire:click="cancelEdit" class="text-gray-600 hover:text-gray-900 ml-2">Cancel</button>
                        @else
                            <button wire:click="editStatus({{ $status->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="deleteStatus({{ $status->id }})" wire:confirm="Are you sure you want to delete this status?" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
