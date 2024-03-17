<?php

namespace App\Http\Livewire\Dashboard\Sectors;

use App\Models\Sector;
use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public $sector;

    public string $name = '';

    public function update()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
        ];

        $validated = $this->validate($rules);

        $this->sector->update($validated);

        return redirect()->route('dashboard.sectors.index');

    }

    public function mount(Sector $sector): void
    {
        $this->sector = $sector;
        $this->name = $sector->name;

        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.sectors.edit');
    }
}
