<?php

namespace App\Http\Livewire\Users\Account;

use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Security extends Component
{

    use LivewireAlert;

    public Authenticatable $user;

    public string $currentPassword = '';
    public string $newPassword = '';
    public string $newPassword_confirmation = '';

    public function mount()
    {

        if (auth()->check()) {

            $this->getUser();

        } else {

            return redirect()->route('home');
        }

    }

    public function updatePassword()
    {

        $rules = [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|max:32|confirmed',
        ];

        $validated = $this->validate($rules);

        if(\Hash::check($validated['currentPassword'], $this->user->password)) {

            $this->user->update([
                'password' => bcrypt($validated['newPassword'])
            ]);

            $this->alert('success', 'Successfully updated password.');
            $this->resetFields();

        } else {
            $this->addError('currentPassword', 'Your current password is invalid.');
        }



    }

    public function resetFields() {
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPassword_confirmation = '';
    }

    public function getUser()
    {

        $this->user = auth()->user();

    }


    public function render()
    {
        return view('livewire.users.account.security')->extends('layouts.store')->section('content');
    }
}
