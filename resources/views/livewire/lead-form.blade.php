<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <h2 class="text-2xl font-semibold mb-4">{{ $lead ? 'Edit Lead' : 'Create Lead' }}</h2>

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- SPOC Contact -->
                <div>
                    <label for="spoc_contact" class="block text-sm font-medium text-gray-700">SPOC Contact</label>
                    <input wire:model="spoc_contact" id="spoc_contact" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('spoc_contact') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- SPOC Email -->
                <div>
                    <label for="spoc_email" class="block text-sm font-medium text-gray-700">SPOC Email</label>
                    <input wire:model="spoc_email" id="spoc_email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('spoc_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- SPOC Designation -->
                <div>
                    <label for="spoc_designation" class="block text-sm font-medium text-gray-700">SPOC Designation</label>
                    <input wire:model="spoc_designation" id="spoc_designation" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input wire:model="company_name" id="company_name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Company Email -->
                <div>
                    <label for="company_email" class="block text-sm font-medium text-gray-700">Company Email</label>
                    <input wire:model="company_email" id="company_email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Company Address -->
                <div class="md:col-span-2">
                    <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                    <textarea wire:model="company_address" id="company_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Lead Source -->
                <div>
                    <label for="lead_source" class="block text-sm font-medium text-gray-700">Lead Source</label>
                    <input wire:model="lead_source" id="lead_source" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Status -->
                <div>
                    <label for="status_id" class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status_id" id="status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Status Reason -->
                <div class="md:col-span-2">
                    <label for="status_reason" class="block text-sm font-medium text-gray-700">Status Reason</label>
                    <textarea wire:model="status_reason" id="status_reason" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Other Flavours -->
                <div class="md:col-span-2">
                    <label for="other_flavours" class="block text-sm font-medium text-gray-700">Other Flavours</label>
                    <textarea wire:model="other_flavours" id="other_flavours" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea wire:model="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Assigned To -->
                <div>
                    <label for="assigned_to_user_id" class="block text-sm font-medium text-gray-700">Assigned To</label>
                    <select wire:model="assigned_to_user_id" id="assigned_to_user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Unassigned</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dynamic Fields -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold mb-2">Additional Information</h3>
                    @foreach($dynamicFields as $field)
                        @php
                            $masterField = \App\Models\CustomField::where('field_key', $field->field_key)->first();
                        @endphp
                        <div class="mb-4">
                            <label for="data.{{ $field->field_key }}" class="block text-sm font-medium text-gray-700">{{ $field->label }}</label>
                            @if($masterField->type === 'text')
                                <input wire:model="data.{{ $field->field_key }}" id="data.{{ $field->field_key }}" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @elseif($masterField->type === 'textarea')
                                <textarea wire:model="data.{{ $field->field_key }}" id="data.{{ $field->field_key }}" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            @elseif($masterField->type === 'dropdown')
                                <select wire:model="data.{{ $field->field_key }}" id="data.{{ $field->field_key }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Select an option</option>
                                    @foreach($masterField->options as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            @elseif($masterField->type === 'checkbox')
                                @foreach($masterField->options as $option)
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" wire:model="data.{{ $field->field_key }}" value="{{ $option }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-600">{{ $option }}</span>
                                    </label>
                                @endforeach
                            @elseif($masterField->type === 'radio')
                                @foreach($masterField->options as $option)
                                    <label class="inline-flex items-center mt-2">
                                        <input type="radio" wire:model="data.{{ $field->field_key }}" value="{{ $option }}" class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-600">{{ $option }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    {{ $lead ? 'Update Lead' : 'Create Lead' }}
                </button>
                <a href="{{ route('leads.index') }}" class="ml-4 text-gray-500 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
