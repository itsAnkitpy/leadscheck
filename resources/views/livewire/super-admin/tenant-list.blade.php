<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenant Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domain</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tenants as $tenant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->domains->first()->domain ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->plan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $tenant->created_at->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleStatus('{{ $tenant->id }}')"
                                    class="px-4 py-2 text-sm font-medium text-white rounded-md
                                           {{ $tenant->status === 'active' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                                {{ $tenant->status === 'active' ? 'Suspend' : 'Reactivate' }}
                            </button>
                            <a href="{{ route('admin.tenants.edit', $tenant) }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                Edit
                            </a>
                            <a href="{{ route('admin.tenant.impersonation', $tenant->id) }}" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Impersonate</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No tenants found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
