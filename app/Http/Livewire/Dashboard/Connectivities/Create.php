<?php

namespace App\Http\Livewire\Dashboard\Connectivities;

use App\Models\Connectivity;
use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public string $name = '';

    public function create()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
        ];

        $validated = $this->validate($rules);

        $connectivity = new Connectivity;
        $connectivity = $connectivity->create($validated);

        return redirect()->route('dashboard.connectivities.index');

    }

    public function mount(): void
    {

        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.connectivities.create');
    }
}
