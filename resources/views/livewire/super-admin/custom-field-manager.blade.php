<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-bold mb-4">Manage Custom Fields</h2>

        <!-- Create Field Form -->
        <form wire:submit.prevent="createField" class="mb-6 p-4 border rounded-md">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="field_key" class="block text-sm font-medium text-gray-700">Field Key</label>
                    <input wire:model.defer="field_key" id="field_key" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('field_key') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                    <input wire:model.defer="label" id="label" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select wire:model="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="dropdown">Dropdown</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                    @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            @if ($type === 'dropdown' || $type === 'checkbox' || $type === 'radio')
                <div class="mt-4">
                    <label for="options" class="block text-sm font-medium text-gray-700">Options (comma-separated)</label>
                    <input wire:model.defer="options" id="options" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('options') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            @endif
            <div class="mt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Create Field
                </button>
            </div>
        </form>

        <!-- Fields List -->
        <h3 class="text-xl font-semibold mb-4">Existing Fields</h3>
        <ul class="space-y-2">
            @foreach ($fields as $field)
                <li class="flex items-center justify-between p-3 bg-gray-50 rounded-md shadow-sm">
                    <div>
                        @if ($editingFieldId === $field->id)
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <input wire:model.defer="editingFieldKey" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <input wire:model.defer="editingLabel" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <select wire:model="editingType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="dropdown">Dropdown</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                </select>
                                @if ($editingType === 'dropdown' || $editingType === 'checkbox' || $editingType === 'radio')
                                    <input wire:model.defer="editingOptions" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Options (comma-separated)">
                                @endif
                            </div>
                        @else
                            <span class="font-bold">{{ $field->label }}</span> ({{ $field->field_key }}) - <span class="text-gray-600">{{ $field->type }}</span>
                            @if($field->options)
                                <span class="text-sm text-gray-500">| Options: {{ implode(', ', $field->options) }}</span>
                            @endif
                        @endif
                    </div>
                    <div>
                        @if ($editingFieldId === $field->id)
                            <button wire:click="updateField" class="text-green-600 hover:text-green-900">Save</button>
                            <button wire:click="cancelEdit" class="text-gray-600 hover:text-gray-900 ml-2">Cancel</button>
                        @else
                            <button wire:click="editField({{ $field->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="deleteField({{ $field->id }})" wire:confirm="Are you sure you want to delete this field?" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
