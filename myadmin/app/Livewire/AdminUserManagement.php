<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AdminUser;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class AdminUserManagement extends Component
{
    use WithPagination;

    public $name;
    public $username;
    public $email;
    public $password;
    public $is_admin = false;
    public $userId;
    public $isEditing = false;
    public $selectedRoles = [];
    public $roles;

    protected $rules = [
        'name' => 'required|min:3',
        'username' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'is_admin' => 'boolean',
        'selectedRoles' => 'array'
    ];

    public function mount()
    {
        if (!auth()->guard('admin')->user()->is_admin) {
            return redirect()->route('dashboard');
        }
        
        $this->roles = Role::all();
    }

    public function render()
    {
        return view('livewire.admin-user-management', [
            'users' => AdminUser::with('roles')->paginate(10),
            'pickers' => AdminUser::whereHas('roles', function($query) {
                $query->where('slug', 'picker');
            })->get(),
            'packers' => AdminUser::whereHas('roles', function($query) {
                $query->where('slug', 'packer');
            })->get()
        ]);
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $user = AdminUser::find($this->userId);
            $user->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password ? Hash::make($this->password) : $user->password,
                'is_admin' => $this->is_admin
            ]);
        } else {
            $user = AdminUser::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'is_admin' => $this->is_admin
            ]);
        }

        // Sync roles
        $user->roles()->sync($this->selectedRoles);

        $this->reset(['name', 'username', 'email', 'password', 'is_admin', 'selectedRoles']);
        $this->isEditing = false;
        session()->flash('message', 'Admin user saved successfully!');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->userId = $id;
        $user = AdminUser::with('roles')->find($id);
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->is_admin = $user->is_admin;
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
        $this->password = '';
    }

    public function delete($id)
    {
        AdminUser::find($id)->delete();
        session()->flash('message', 'Admin user deleted successfully!');
    }
}