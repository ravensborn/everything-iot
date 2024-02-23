<?php

namespace App\Http\Livewire\Website\Faq;

use App\Models\Category;
use App\Models\FaqItem;
use Livewire\Component;


class Index extends Component
{
    public string $search = '';

    public $categories;
    public int $faqItemsCount = 0;

    public function mount(): void
    {
        $this->categories = collect();
    }

    public function render()
    {
        $query = Category::withCount('faqItems')->where('model', FaqItem::class);

        if ($this->search) {
            $query->whereHas('faqItems', function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                });
        }

        $this->categories = $query->get();
        $this->faqItemsCount = $this->categories->sum('faq_items_count');

        return view('livewire.website.faq.index')->extends('layouts.master')->section('content');
    }
}
