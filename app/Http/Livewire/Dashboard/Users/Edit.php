<?php

namespace App\Http\Livewire\Dashboard\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{

    use LivewireAlert;

    public $user;

    public string $userName = '';
    public string $userEmail = '';
    public string $userPhoneNumber = '';

    public function updateUser(): void
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

            $this->alert('success', 'Successfully updated user.');
            $this->user = \App\Models\User::find($this->user->id);
        }

    }


    public function mount(User $user): void
    {
        $this->user = $user;

        $this->userName = $user->name;
        $this->userEmail = $user->email;
        $this->userPhoneNumber = $user->phone_number;
    }

    public function render()
    {
        return view('livewire.dashboard.users.edit');
    }
}
