<?php

namespace App\Http\Livewire\Dashboard\Partners;

use App\Models\Partner;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public $partner;

    public string $name = '';
    public bool $is_visible = true;
    public $image;
    public $currentImage = '';

    public function update()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'is_visible' => 'required|boolean',
        ];

        $validated = $this->validate($rules);

        $this->partner->update($validated);

        if ($this->image) {

            $this->partner->clearMediaCollection('image');

            $name = time() . '_' . Str::random(5);

            $this->partner->addMedia($this->image)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->image->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        return redirect()->route('dashboard.partners.index');

    }

    public function mount(Partner $partner): void
    {
        $this->partner = $partner;
        $this->name = $partner->name;
        $this->is_visible = $partner->is_visible;

        if($this->partner->hasMedia('image')) {
            $this->currentImage = $this->partner->getFirstMediaUrl('image');
        }

        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.partners.edit');
    }
}
