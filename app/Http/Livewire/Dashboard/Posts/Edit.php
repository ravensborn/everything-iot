<?php

namespace App\Http\Livewire\Dashboard\Posts;


use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Edit extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public Collection $categories;

    public $post;

    public int $category_id = 0;
    public string $locale = '';
    public string $title = '';
    public bool $is_hidden = false;
    public bool $is_commentable = false;

    public string $content = '';

    public function updatePost()
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

        $this->post->update($validated);

        return redirect()->route('dashboard.posts.index');

    }

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->categories = Category::where('model', Post::class)->get();
        $this->user = auth()->user();
        $this->category_id = $post->category_id;
        $this->locale = $post->locale;
        $this->title = $post->title;
        $this->is_hidden = $post->is_hidden;
        $this->is_commentable = $post->is_commentable;
        $this->content = $post->content;
    }

    public function render()
    {
        return view('livewire.dashboard.posts.edit');
    }
}
