<?php

namespace App\Http\Livewire\Dashboard\PromoCodes;

use App\Models\PromoCode;
use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Create extends Component
{
    use LivewireAlert;

    public Authenticatable $user;

    public string $name = '';
    public string $code = '';
    public int $max_uses = 50;
    public string $discount_type = '';
    public int $discount_amount = 0;

    public array $discountTypes = [PromoCode::DISCOUNT_TYPE_FIXED, PromoCode::DISCOUNT_TYPE_PERCENTAGE];

    public function create()
    {
        $rules = [
            'name' => 'required|string|min:3|max:20',
            'code' => 'required|string|min:3|max:20',
            'max_uses' => 'required|integer|gt:0',
            'discount_type' => 'required|string|in:' . PromoCode::DISCOUNT_TYPE_FIXED . ',' . PromoCode::DISCOUNT_TYPE_PERCENTAGE,
            'discount_amount' => 'required|integer|gt:0'
        ];

        $validated = $this->validate($rules);

        $promoCode = new PromoCode;
        $promoCode = $promoCode->create($validated);

        return redirect()->route('dashboard.promo-codes.index');

    }

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard.promo-codes.create');
    }
}
