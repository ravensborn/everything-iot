<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RoleManager extends Component
{

    use LivewireAlert;

    public $user;
    public array $userRoles = [];

    public function toggleRole($roleName): void
    {
        if ($this->user->hasRole($roleName)) {

            $this->user->removeRole($roleName);
        } else {

            $this->user->assignRole($roleName);
        }

        $this->loadUserRoles();
    }

    public function loadUserRoles(): void
    {
        $this->userRoles = $this->user->getRoleNames()->toArray();
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->loadUserRoles();
    }

    public function render()
    {
        return view('livewire.dashboard.users.role-manager');
    }
}
