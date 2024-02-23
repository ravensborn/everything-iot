<?php

namespace App\Http\Livewire\Dashboard\MenuBuilder;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Index extends Component
{
    use LivewireAlert;

    public Collection $menus;

    public function mount(): void
    {

        $this->menus = Menu::all();

    }

    public function render()
    {
        return view('livewire.dashboard.menu-builder.index');
    }
}
