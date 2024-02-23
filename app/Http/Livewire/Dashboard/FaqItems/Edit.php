<?php

namespace App\Http\Livewire\Dashboard\FaqItems;

use App\Models\Category;
use App\Models\FaqItem;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public $faqItem;

    public string $title = '';
    public string $description = '';
    public Collection $categories;


    public function update()
    {
        $rules = [
            'title' => 'required|string|min:1|max:500',
            'description' => 'required|string|min:1|max:50000',
        ];

        $validated = $this->validate($rules);
        $this->faqItem->update($validated);

        return redirect()->route('dashboard.faq-items.index');
    }



    public function mount(FaqItem $faqItem): void
    {
        $this->user = auth()->user();

        $this->faqItem = $faqItem;
        $this->title = $faqItem->title;
        $this->description = $faqItem->description;


    }

    public function render()
    {
        return view('livewire.dashboard.faq-items.edit');
    }
}
