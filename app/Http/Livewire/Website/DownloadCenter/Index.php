<?php

namespace App\Http\Livewire\Website\DownloadCenter;

use App\Models\DownloadableFile;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{

    use WithPagination;

    public string $paginationTheme = 'bootstrap';

    public string $search = '';
    private $files;

    public function mount(): void
    {

        $this->files = collect();
    }

    public function render()
    {

        if($this->search) {
            $this->files = DownloadableFile::where('name', 'LIKE', '%' . $this->search . '%')
                ->paginate(6);
        } else {
            $this->files = DownloadableFile::orderBy('created_at', 'desc')
                ->paginate(6);
        }

        return view('livewire.website.download-center.index', ['loadedFiles' => $this->files])->extends('layouts.master')->section('content');
    }
}
