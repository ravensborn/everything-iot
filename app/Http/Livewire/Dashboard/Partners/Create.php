<?php

namespace App\Http\Livewire\Dashboard\Partners;

use App\Models\Partner;
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
    public bool $is_visible = true;
    public $image;

    public function create()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'is_visible' => 'required|boolean',
        ];

        $validated = $this->validate($rules);

        $order = 1;

        $firstPartner = Partner::orderBy('order', 'desc')->first();

        if ($firstPartner) {
            $order = $firstPartner->order + 1;
        }

        $validated['order'] = $order;

        $partner = new Partner;
        $partner = $partner->create($validated);

        if ($this->image) {

            $name = time() . '_' . Str::random(5);

            $partner->addMedia($this->image)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->image->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        return redirect()->route('dashboard.partners.index');

    }

    public function mount(): void
    {

        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.partners.create');
    }
}
