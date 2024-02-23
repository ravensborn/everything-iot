<?php

namespace App\Http\Livewire\Dashboard\DownloadCenter;

use App\Models\Brand;
use App\Models\Category;
use App\Models\DownloadableFile;
use App\Models\EnabledCountry;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public Authenticatable $user;

    public string $name = '';
    public string $description = '';
    public $file;

    public function create()
    {
        $rules = [
            'name' => 'required|string|min:1|max:50',
            'description' => 'required|string|min:1|max:1000',
            'file' => 'required|file|mimes:zip,rar,7z|max:30720',
        ];

        $validated = $this->validate($rules);

        if ($this->file) {
            $model = new DownloadableFile;
            $model = $model->create($validated);

            $name = time() . '_' . Str::random(5);

            $model->addMedia($this->file)
                ->usingName($name)
                ->usingFileName($name . '.' . $this->file->getClientOriginalExtension())
                ->toMediaCollection('files');
        }

        return redirect()->route('dashboard.download-center.index');

    }

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.download-center.create');
    }
}
