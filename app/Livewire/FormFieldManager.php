<?php

namespace App\Livewire;

use App\Models\CustomField;
use App\Models\TenantFormField;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FormFieldManager extends Component
{
    public $masterFields;
    public $tenantFields;

    public function mount()
    {
        $this->loadFields();
    }

    public function loadFields()
    {
        // Switch to central context to get master fields
        DB::connection('mysql')->reconnect();
        $this->masterFields = CustomField::all();

        // Switch back to tenant context
        DB::connection('tenant')->reconnect();
        $this->tenantFields = TenantFormField::all()->keyBy('field_key');

        // Sync master fields with tenant fields
        foreach ($this->masterFields as $masterField) {
            if (!isset($this->tenantFields[$masterField->field_key])) {
                TenantFormField::create([
                    'field_key' => $masterField->field_key,
                    'label' => $masterField->label,
                    'is_enabled' => false, // Disabled by default
                    'order' => 0,
                ]);
            }
        }

        $this->tenantFields = TenantFormField::orderBy('order')->get()->keyBy('field_key');
    }

    public function toggleField($fieldKey)
    {
        $field = TenantFormField::where('field_key', $fieldKey)->first();
        if ($field) {
            $field->update(['is_enabled' => !$field->is_enabled]);
            $this->loadFields();
        }
    }

    public function updateFieldOrder($list)
    {
        foreach ($list as $item) {
            TenantFormField::where('field_key', $item['value'])->update(['order' => $item['order']]);
        }
        $this->loadFields();
    }

    public function render()
    {
        return view('livewire.form-field-manager');
    }
}
