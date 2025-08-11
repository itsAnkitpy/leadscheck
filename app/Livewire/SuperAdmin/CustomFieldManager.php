<?php

namespace App\Livewire\SuperAdmin;

use App\Models\CustomField;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class CustomFieldManager extends Component
{
    use WithPagination;

    public $fields;
    public $field_key;
    public $label;
    public $type = 'text';
    public $options = ''; // Comma-separated string
    public $description = '';
    public $is_required = false;

    public $editingFieldId;
    public $editingFieldKey;
    public $editingLabel;
    public $editingType;
    public $editingOptions;
    public $editingDescription;
    public $editingIsRequired;

    public $search = '';
    public $typeFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => ''],
    ];

    public function mount()
    {
        $this->loadFields();
    }

    public function loadFields()
    {
        $this->fields = CustomField::when($this->search, function ($query) {
                $query->where('label', 'like', '%' . $this->search . '%')
                      ->orWhere('field_key', 'like', '%' . $this->search . '%');
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updatingSearch()
    {
        $this->loadFields();
    }

    public function updatingTypeFilter()
    {
        $this->loadFields();
    }

    public function createField()
    {
        $this->validate([
            'field_key' => 'required|string|max:255|unique:custom_fields,field_key',
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,textarea,dropdown,checkbox,radio,email,number,date,url',
            'options' => 'nullable|string',
            'description' => 'nullable|string|max:500',
        ]);

        CustomField::create([
            'field_key' => $this->field_key,
            'label' => $this->label,
            'type' => $this->type,
            'options' => $this->type === 'text' || $this->type === 'textarea' || $this->type === 'email' || $this->type === 'number' || $this->type === 'date' || $this->type === 'url' ? null : explode(',', $this->options),
            'description' => $this->description,
            'is_required' => $this->is_required,
        ]);

        $this->reset('field_key', 'label', 'type', 'options', 'description', 'is_required');
        $this->loadFields();
        session()->flash('message', 'Custom field created successfully!');
        $this->dispatch('field-created');
    }

    public function editField($fieldId)
    {
        $field = CustomField::findOrFail($fieldId);
        $this->editingFieldId = $field->id;
        $this->editingFieldKey = $field->field_key;
        $this->editingLabel = $field->label;
        $this->editingType = $field->type;
        $this->editingOptions = is_array($field->options) ? implode(',', $field->options) : '';
        $this->editingDescription = $field->description;
        $this->editingIsRequired = $field->is_required;
    }

    public function updateField()
    {
        $this->validate([
            'editingFieldKey' => 'required|string|max:255|unique:custom_fields,field_key,' . $this->editingFieldId,
            'editingLabel' => 'required|string|max:255',
            'editingType' => 'required|string|in:text,textarea,dropdown,checkbox,radio,email,number,date,url',
            'editingOptions' => 'nullable|string',
            'editingDescription' => 'nullable|string|max:500',
        ]);

        $field = CustomField::findOrFail($this->editingFieldId);
        $field->update([
            'field_key' => $this->editingFieldKey,
            'label' => $this->editingLabel,
            'type' => $this->editingType,
            'options' => $this->editingType === 'text' || $this->editingType === 'textarea' || $this->editingType === 'email' || $this->editingType === 'number' || $this->editingType === 'date' || $this->editingType === 'url' ? null : explode(',', $this->editingOptions),
            'description' => $this->editingDescription,
            'is_required' => $this->editingIsRequired,
        ]);

        $this->cancelEdit();
        $this->loadFields();
        session()->flash('message', 'Custom field updated successfully!');
        $this->dispatch('field-updated');
    }

    public function cancelEdit()
    {
        $this->reset('editingFieldId', 'editingFieldKey', 'editingLabel', 'editingType', 'editingOptions', 'editingDescription', 'editingIsRequired');
    }

    public function deleteField($fieldId)
    {
        $field = CustomField::findOrFail($fieldId);
        
        // For now, allow deletion of all fields
        // In a production system, you would check tenant usage here
        
        $field->delete();
        $this->loadFields();
        session()->flash('message', 'Custom field deleted successfully!');
        $this->dispatch('field-deleted');
    }

    public function render()
    {
        return view('livewire.super-admin.custom-field-manager');
    }
}
