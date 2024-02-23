<?php

namespace App\Http\Livewire\Users\Account;

use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Overview extends Component
{

    use LivewireAlert;

    public Authenticatable $user;

    public string $userName = '';
    public string $userEmail = '';
    public string $userPhoneNumber = '';

    public function mount()
    {

        if (auth()->check()) {

            $this->getUser();

        } else {

            return redirect()->route('home');
        }

    }

    public function updateUser()
    {

        $rules = [
            'userName' => ['required', 'string', 'max:255'],
            'userEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,name'],
            'userPhoneNumber' => ['required', 'phone:IQ', 'max:255', 'unique:users,phone_number,' . $this->user->id],
        ];


        $validated = $this->validate($rules);

        if ($this->user->update([
            'name' => $validated['userName'],
            'email' => $validated['userEmail'],
            'phone_number' => phone($validated['userPhoneNumber'], $this->user->country->iso_alpha_2, 'E164'),
        ])) {

            $this->alert('success', 'Successfully updated.');
            $this->user = \App\Models\User::find(auth()->user()->id);
            $this->emit('refresh-navbar');
        }

    }

    public function getUser()
    {

        $this->user = auth()->user();

        $this->userName = $this->user->name;
        $this->userEmail = $this->user->email;
        $this->userPhoneNumber = $this->user->phone_number;

    }


    public function render()
    {
        return view('livewire.users.account.overview')->extends('layouts.store')->section('content');
    }
}
