<?php

namespace App\Http\Livewire\Dashboard\Posts;

use App\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;



class MediaManager extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;
    public $post;

    public $photo;

    public function updatedPhoto(): void
    {
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
        ]);

        $name = time() . '_' . Str::random(5);

        $this->post->clearMediaCollection('cover');
        $this->post->addMedia($this->photo)
            ->usingName($name)
            ->usingFileName($name . '.' . $this->photo->getClientOriginalExtension())
            ->toMediaCollection('cover');
    }


    public function removeCover(): void
    {
        $this->post->clearMediaCollection('cover');

    }


    public function mount(Post $post): void
    {

        $this->post = $post;

    }

    public function render()
    {
        return view('livewire.dashboard.posts.media-manager');
    }
}
