<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.users.index');
    }
}
