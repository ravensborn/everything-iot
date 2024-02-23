<?php

namespace App\Http\Livewire\Users\Store;

use Illuminate\Contracts\Auth\Authenticatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Wishlist extends Component
{

    use LivewireAlert, WithPagination;

    protected string $paginationTheme = 'bootstrap';

    protected $items;
    public Authenticatable $user;

    public function removeFromWishlist($item)
    {

        $item = $this->user->wishlist->find($item);

        if ($item) {
            $item->delete();
            $this->alert('success', 'Successfully removed.');
            $this->loadWishlist();
        } else {
            $this->alert('error', 'Error while removing item from wishlist.');
        }

    }

    public function loadWishlist()
    {
        $this->items = \App\Models\Wishlist::where('user_id', $this->user->id);
    }

    public function mount()
    {
        $this->user = auth()->user();

    }

    public function render()
    {
        $this->loadWishlist();

        return view('livewire.users.store.wishlist', [
            'items' => $this->items->paginate(6)
        ])->extends('layouts.store')->section('content');
    }
}
