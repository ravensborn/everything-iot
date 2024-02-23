<?php

namespace App\Http\Livewire\Users\Account\Components;

use Illuminate\Contracts\Auth\Authenticatable;
use Livewire\Component;

class NavbarComponent extends Component
{

    protected $listeners = [
        'refresh-navbar' => 'getUser'
    ];

    public Authenticatable $user;

    public string $userName = '';
    public string $userEmail = '';
    public string $userPhoneNumber = '';

    public string $navbarPage = '';

    public function getUser()
    {

        $this->user = auth()->user();

        $this->userName = $this->user->name;
        $this->userEmail = $this->user->email;
        $this->userPhoneNumber = $this->user->phone_number;

    }

    public function mount($active)
    {

        $this->navbarPage = $active;

        if (auth()->check()) {

            $this->getUser();

        } else {

            return redirect()->route('home');
        }

    }

    public function render()
    {
        return view('livewire.users.account.components.navbar-component');
    }
}
