<div>
    @if (session()->has('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveFeatures">
        <h3 class="text-lg font-medium text-gray-900">Manage Features for {{ $tenant->id }}</h3>
        <div class="mt-4 space-y-4">
            @foreach ($allFeatures as $feature)
                <div>
                    <label for="feature-{{ $feature->id }}" class="inline-flex items-center">
                        <input id="feature-{{ $feature->id }}" type="checkbox" 
                               wire:model="selectedFeatures" 
                               value="{{ $feature->id }}"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">{{ $feature->name }}</span>
                    </label>
                    <p class="text-xs text-gray-500 ml-6">{{ $feature->description }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Save Features
            </button>
        </div>
    </form>
</div>
