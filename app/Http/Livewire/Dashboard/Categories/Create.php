<?php

namespace App\Http\Livewire\Dashboard\Categories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\EnabledCountry;
use App\Models\FaqItem;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Create extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public array $models = [];

    public string $name = '';
    public string $model = '';

    public function createCategory()
    {
        $rules = [
            'name' => 'required|string|min:1|max:20',
            'model' => 'required|string',
        ];

        $validated = $this->validate($rules);

        $category = new Category;
        $category = $category->create($validated);

        return redirect()->route('dashboard.categories.index');

    }

    public function mount(): void
    {
        $this->models = [
            [
                'name' => 'Post',
                'class' => Post::class,
            ],
            [
                'name' => 'Product',
                'class' => Product::class,
            ],
            [
                'name' => 'FAQ',
                'class' => FaqItem::class,
            ],
        ];
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create');
    }
}
