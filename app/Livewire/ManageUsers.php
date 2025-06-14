<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public $users;
    public $first_name, $last_name, $email, $userId;
    public $isEditing = false;

    public $password, $password_confirmation;
    public $showPasswordModalFlag = false;

    protected $rules = [
        'first_name'  => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::all();
    }

    public function save()
    {
        $this->validate();

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => bcrypt($this->password), // Default password, ubah sesuai kebutuhan
        ]);

        $this->resetForm();
        $this->loadUsers();
        session()->flash('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ]);

        $this->resetForm();
        $this->loadUsers();
        session()->flash('success', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->loadUsers();
        session()->flash('success', 'User berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->userId = null;
        $this->isEditing = false;
    }

    public function showPasswordModal($id)
    {
        $this->reset(['password', 'password_confirmation']);
        $this->userId = $id;
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        $user = User::findOrFail($this->userId);
        $user->update([
            'password' => bcrypt($this->password),
        ]);
    
        // Dispatch event untuk menutup modal
        $this->dispatch('close-modal');
        $this->dispatch('show-toast', ['type' => 'success']); // Memicu toast muncul
        $this->dispatch('show-toast', ['type' => 'error']);

        session()->flash('success', 'Password berhasil diubah.');
        $this->reset(['password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.manage-users');
    }
}
