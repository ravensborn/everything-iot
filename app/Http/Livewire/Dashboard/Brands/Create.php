<?php

namespace App\Http\Livewire\Dashboard\Brands;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public string $name = '';
    public bool $is_displayable_on_website = false;
    public $icon;



    public function create()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'icon' => 'sometimes|required|image|mimes:jpeg,jpg,png|max:2048',
            'is_displayable_on_website' => 'required|boolean',
        ];

        $validated = $this->validate($rules);

        $brand = new Brand;
        $brand = $brand->create($validated);

        if ($this->icon) {

            $name = time() . '_' . Str::random(5);

            $brand->addMedia($this->icon)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->icon->getClientOriginalExtension())
                ->toMediaCollection('icon');
        }

        return redirect()->route('dashboard.brands.index');

    }

    public function mount(): void
    {

        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.brands.create');
    }
}
