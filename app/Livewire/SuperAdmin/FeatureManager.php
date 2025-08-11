<?php

namespace App\Livewire\SuperAdmin;

use App\Models\Feature;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class FeatureManager extends Component
{
    public $features;
    public $name;
    public $key;
    public $description;
    
    public $editingFeatureId;
    public $editingName;
    public $editingKey;
    public $editingDescription;

    public function mount()
    {
        $this->loadFeatures();
    }

    public function loadFeatures()
    {
        $this->features = Feature::orderBy('name')->get();
    }

    public function createFeature()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:features,key',
            'description' => 'nullable|string',
        ]);

        Feature::create([
            'name' => $this->name,
            'key' => $this->key,
            'description' => $this->description,
        ]);

        $this->reset('name', 'key', 'description');
        $this->loadFeatures();
        $this->dispatch('feature-created');
    }

    public function editFeature($featureId)
    {
        $feature = Feature::findOrFail($featureId);
        $this->editingFeatureId = $feature->id;
        $this->editingName = $feature->name;
        $this->editingKey = $feature->key;
        $this->editingDescription = $feature->description;
    }

    public function updateFeature()
    {
        $this->validate([
            'editingName' => 'required|string|max:255',
            'editingKey' => 'required|string|max:255|unique:features,key,' . $this->editingFeatureId,
            'editingDescription' => 'nullable|string',
        ]);

        $feature = Feature::findOrFail($this->editingFeatureId);
        $feature->update([
            'name' => $this->editingName,
            'key' => $this->editingKey,
            'description' => $this->editingDescription,
        ]);

        $this->cancelEdit();
        $this->loadFeatures();
        $this->dispatch('feature-updated');
    }

    public function cancelEdit()
    {
        $this->reset('editingFeatureId', 'editingName', 'editingKey', 'editingDescription');
    }

    public function deleteFeature($featureId)
    {
        $feature = Feature::findOrFail($featureId);
        
        // Check if any tenants are using this feature
        if ($feature->tenants()->count() > 0) {
            $this->dispatch('error', 'Cannot delete feature that is assigned to tenants.');
            return;
        }
        
        $feature->delete();
        $this->loadFeatures();
        $this->dispatch('feature-deleted');
    }

    public function render()
    {
        return view('livewire.super-admin.feature-manager');
    }
}
