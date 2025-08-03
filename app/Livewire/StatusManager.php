<?php

namespace App\Livewire;

use App\Models\LeadStatus;
use Livewire\Component;

class StatusManager extends Component
{
    public $statuses;
    public $name;
    public $color = '#000000';
    public $editingStatusId;
    public $editingStatusName;
    public $editingStatusColor;

    public function mount()
    {
        $this->loadStatuses();
    }

    public function loadStatuses()
    {
        $this->statuses = LeadStatus::orderBy('order')->get();
    }

    public function createStatus()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:lead_statuses,name',
            'color' => 'required|string|max:7',
        ]);

        LeadStatus::create([
            'name' => $this->name,
            'color' => $this->color,
            'order' => $this->statuses->count() + 1,
        ]);

        $this->reset('name', 'color');
        $this->loadStatuses();
        $this->dispatch('status-created');
    }

    public function editStatus($statusId)
    {
        $status = LeadStatus::findOrFail($statusId);
        $this->editingStatusId = $status->id;
        $this->editingStatusName = $status->name;
        $this->editingStatusColor = $status->color;
    }

    public function updateStatus()
    {
        $this->validate([
            'editingStatusName' => 'required|string|max:255|unique:lead_statuses,name,' . $this->editingStatusId,
            'editingStatusColor' => 'required|string|max:7',
        ]);

        $status = LeadStatus::findOrFail($this->editingStatusId);
        $status->update([
            'name' => $this->editingStatusName,
            'color' => $this->editingStatusColor,
        ]);

        $this->cancelEdit();
        $this->loadStatuses();
        $this->dispatch('status-updated');
    }

    public function cancelEdit()
    {
        $this->reset('editingStatusId', 'editingStatusName', 'editingStatusColor');
    }

    public function deleteStatus($statusId)
    {
        // Note: Add logic here to handle re-assigning leads with this status
        LeadStatus::findOrFail($statusId)->delete();
        $this->loadStatuses();
        $this->dispatch('status-deleted');
    }

    public function updateStatusOrder($list)
    {
        foreach ($list as $item) {
            LeadStatus::find($item['value'])->update(['order' => $item['order']]);
        }
        $this->loadStatuses();
    }

    public function render()
    {
        return view('livewire.status-manager');
    }
}
