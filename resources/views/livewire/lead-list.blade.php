<div>
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold">Leads</h2>
            <a href="{{ route('leads.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                Create Lead
            </a>
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="w-1/3">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search leads..." class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="w-1/4">
                <select wire:model.live="status" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/4">
                <select wire:model.live="user" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">
                        <button wire:click="sortBy('spoc_contact')" class="font-bold">
                            Contact
                            @if($sortBy === 'spoc_contact')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2 text-left">
                        <button wire:click="sortBy('company_name')" class="font-bold">
                            Company
                            @if($sortBy === 'company_name')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2 text-left">
                        <button wire:click="sortBy('status_id')" class="font-bold">
                            Status
                            @if($sortBy === 'status_id')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2 text-left">
                        <button wire:click="sortBy('assigned_to_user_id')" class="font-bold">
                            Assigned To
                            @if($sortBy === 'assigned_to_user_id')
                                <span class="ml-1">{{ $sortDirection === 'asc' ? '▲' : '▼' }}</span>
                            @endif
                        </button>
                    </th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $lead->spoc_contact }}</td>
                        <td class="px-4 py-2">{{ $lead->company_name }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold text-white rounded-full" style="background-color: {{ $lead->status->color }};">
                                {{ $lead->status->name }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $lead->assignedTo->name ?? 'Unassigned' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('leads.edit', $lead) }}" class="text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $leads->links() }}
        </div>
    </div>
</div>
