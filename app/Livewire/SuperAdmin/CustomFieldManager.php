<?php

namespace App\Livewire\SuperAdmin;

use App\Models\CustomField;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class CustomFieldManager extends Component
{
    public $fields;
    public $field_key;
    public $label;
    public $type = 'text';
    public $options = ''; // Comma-separated string

    public $editingFieldId;
    public $editingFieldKey;
    public $editingLabel;
    public $editingType;
    public $editingOptions;

    public function mount()
    {
        $this->loadFields();
    }

    public function loadFields()
    {
        $this->fields = CustomField::all();
    }

    public function createField()
    {
        $this->validate([
            'field_key' => 'required|string|max:255|unique:custom_fields,field_key',
            'label' => 'required|string|max:255',
            'type' => 'required|string|in:text,textarea,dropdown,checkbox,radio',
            'options' => 'nullable|string',
        ]);

        CustomField::create([
            'field_key' => $this->field_key,
            'label' => $this->label,
            'type' => $this->type,
            'options' => $this->type === 'text' || $this->type === 'textarea' ? null : explode(',', $this->options),
        ]);

        $this->reset('field_key', 'label', 'type', 'options');
        $this->loadFields();
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
    }

    public function updateField()
    {
        $this->validate([
            'editingFieldKey' => 'required|string|max:255|unique:custom_fields,field_key,' . $this->editingFieldId,
            'editingLabel' => 'required|string|max:255',
            'editingType' => 'required|string|in:text,textarea,dropdown,checkbox,radio',
            'editingOptions' => 'nullable|string',
        ]);

        $field = CustomField::findOrFail($this->editingFieldId);
        $field->update([
            'field_key' => $this->editingFieldKey,
            'label' => $this->editingLabel,
            'type' => $this->editingType,
            'options' => $this->editingType === 'text' || $this->editingType === 'textarea' ? null : explode(',', $this->editingOptions),
        ]);

        $this->cancelEdit();
        $this->loadFields();
        $this->dispatch('field-updated');
    }

    public function cancelEdit()
    {
        $this->reset('editingFieldId', 'editingFieldKey', 'editingLabel', 'editingType', 'editingOptions');
    }

    public function deleteField($fieldId)
    {
        CustomField::findOrFail($fieldId)->delete();
        $this->loadFields();
        $this->dispatch('field-deleted');
    }

    public function render()
    {
        return view('livewire.super-admin.custom-field-manager');
    }
}
