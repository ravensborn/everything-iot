<?php

namespace App\Http\Livewire\Users\Account;

use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.users.account.notifications')->extends('layouts.store')->section('content');
    }
}
