<?php

namespace App\Http\Livewire\Dashboard\Connectivities;

use App\Models\Connectivity;
use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public $connectivity;

    public string $name = '';

    public function update()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
        ];

        $validated = $this->validate($rules);

        $this->connectivity->update($validated);

        return redirect()->route('dashboard.connectivities.index');

    }

    public function mount(Connectivity $connectivity): void
    {
        $this->connectivity = $connectivity;
        $this->name = $connectivity->name;

        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.connectivities.edit');
    }
}
