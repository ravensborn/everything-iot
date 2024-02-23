<?php

namespace App\Http\Livewire\Users\Account;

use Livewire\Component;

class Preferences extends Component
{
    public function render()
    {
        return view('livewire.users.account.preferences')->extends('layouts.store')->section('content');
    }
}
