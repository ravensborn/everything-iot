<?php

namespace App\Http\Livewire\Dashboard\Posts;

use App\Models\Brand;
use App\Models\Category;
use App\Models\EnabledCountry;
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

    public Collection $categories;


    public int $category_id = 0;
    public string $locale = '';
    public string $title = '';
    public bool $is_hidden = false;
    public bool $is_commentable = false;

    public string $content = '';

    public function createPost()
    {
        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'locale' => 'required|string|in:en,ar,ku',
            'title' => 'required|string|min:3|max:100',
            'is_hidden' => 'required|boolean',
            'is_commentable' => 'required|boolean',
            'content' => 'nullable|max:100000',
        ];

        $validated = $this->validate($rules);

        $validated['author_id'] = $this->user->id;

        $post = new Post;
        $post = $post->create($validated);

        return redirect()->route('dashboard.posts.edit', ['slug' => $post->slug]);

    }

    public function mount(): void
    {
        $this->categories = Category::where('model', Post::class)->get();
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.posts.create');
    }
}
