<?php

namespace App\Http\Livewire\Dashboard\Categories;


use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Edit extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public $category;

    public string $name = '';


    public function updateCategory()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
        ];

        $validated = $this->validate($rules);

        $this->category->update($validated);

        return redirect()->route('dashboard.categories.index');

    }

    public function mount(Category $category): void
    {
        $this->category = $category;
        $this->name = $category->name;

        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.categories.edit');
    }
}
