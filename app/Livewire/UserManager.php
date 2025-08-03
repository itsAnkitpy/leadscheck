<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManager extends Component
{
    public $users;
    public $roles;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $selectedRoles = [];
    public $isModalOpen = false;

    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.user-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selectedRoles = [];
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'required_if:userId,null',
        ]);

        $user = User::updateOrCreate(['id' => $this->userId], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->syncRoles($this->selectedRoles);

        session()->flash('message', $this->userId ? 'User updated successfully.' : 'User created successfully.');

        $this->closeModal();
        $this->resetInputFields();
        $this->users = User::all();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles->pluck('name')->toArray();

        $this->openModal();
    }

    public function delete($id)
    {
        if ($id == auth()->user()->id) {
            session()->flash('error', 'You cannot delete your own account.');
            return;
        }

        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
        $this->users = User::all();
    }
}
