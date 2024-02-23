<?php

namespace App\Http\Livewire\Dashboard\Brands;

use App\Models\Brand;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public $brand;

    public string $name = '';
    public bool $is_displayable_on_website = false;
    public $icon = '';
    public $currentIcon = '';

    public function update()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'icon' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'is_displayable_on_website' => 'required|boolean',
        ];

        $validated = $this->validate($rules);

        $this->brand->update($validated);

        if ($this->icon) {

            $this->brand->clearMediaCollection('icon');

            $name = time() . '_' . Str::random(5);

            $this->brand->addMedia($this->icon)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->icon->getClientOriginalExtension())
                ->toMediaCollection('icon');
        }

        return redirect()->route('dashboard.brands.index');

    }

    public function mount(Brand $brand): void
    {
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->is_displayable_on_website = $brand->is_displayable_on_website;

        if($this->brand->hasMedia('icon')) {
            $this->currentIcon = $this->brand->getFirstMediaUrl('icon');
        }

        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.brands.edit');
    }
}
