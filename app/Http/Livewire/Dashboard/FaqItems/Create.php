<?php

namespace App\Http\Livewire\Dashboard\FaqItems;

use App\Models\Category;
use App\Models\FaqItem;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Create extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public string $title = '';
    public string $description = '';
    public int $category_id = 0;
    public Collection $categories;


    public function create()
    {
        $rules = [
            'title' => 'required|string|min:1|max:500',
            'description' => 'required|string|min:1|max:50000',
            'category_id' => 'required|integer|exists:categories,id',
        ];

        $validated = $this->validate($rules);

        $order = 1;

        $firstFaqItem = FaqItem::where('category_id', $this->category_id)->orderBy('order', 'desc')->first();

        if ($firstFaqItem) {
            $order = $firstFaqItem->order + 1;
        }

        $validated['order'] = $order;

        $faqItem = new FaqItem;
        $faqItem = $faqItem->create($validated);

        return redirect()->route('dashboard.faq-items.index');

    }

    public function loadCategories(): void
    {
        $this->categories = Category::where('model', FaqItem::class)->get();
    }

    public function mount(): void
    {

        $this->user = auth()->user();
        $this->loadCategories();

        if ($this->categories->count() > 0) {
            $firstCategory = $this->categories->first();
            if ($firstCategory) {
                $this->category_id = $firstCategory->id;
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.faq-items.create');
    }
}
