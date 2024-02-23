<?php

namespace App\Http\Livewire\Store\CartItems;

use App\Models\CartItem;
use Livewire\Component;

class HeaderCartComponent extends Component
{

    protected $listeners = [
        'refresh-header-cart' => 'mount'
    ];

    public int $count = 0;

    public function mount() {

        if(auth()->check()) {

            $this->count = auth()->user()->cartItems()->count();
        }
    }

    public function render()
    {
        return view('livewire.store.cart-items.header-cart-component');
    }
}
