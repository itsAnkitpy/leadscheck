<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-bold mb-4">Manage Form Fields</h2>

        <p class="mb-6 text-gray-600">
            Enable or disable fields for your lead capture form. Drag and drop to reorder.
        </p>

        <ul wire:sortable="updateFieldOrder" class="space-y-2">
            @if($masterFields)
                @foreach ($masterFields as $field)
                    <li wire:sortable.item="{{ $field->field_key }}" wire:key="field-{{ $field->field_key }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-md shadow-sm">
                        <div class="flex items-center space-x-3">
                            <span wire:sortable.handle class="cursor-move">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </span>
                            <span>{{ $field->label }}</span>
                        </div>
                        <div>
                            <label for="toggle-{{ $field->field_key }}" class="inline-flex items-center cursor-pointer">
                                <span class="relative">
                                    <input id="toggle-{{ $field->field_key }}" type="checkbox" class="sr-only" wire:change="toggleField('{{ $field->field_key }}')"
                                        {{ isset($tenantFields[$field->field_key]) && $tenantFields[$field->field_key]->is_enabled ? 'checked' : '' }}>
                                    <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                    <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                </span>
                            </label>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>

<style>
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
