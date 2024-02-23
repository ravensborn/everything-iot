<?php

namespace App\Http\Livewire\Users\Store;

use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected Builder $orders;
    public Authenticatable $user;

    public function loadOrders()
    {
        $this->orders = Order::where('user_id', $this->user->id)->latest();
    }

    public function mount()
    {
        $this->user = auth()->user();
    }


    public function render()
    {

        $this->loadOrders();

        $orders = $this->orders->paginate(6);

        return view('livewire.users.store.orders-index', [
            'orders' => $orders,
        ])->extends('layouts.store')->section('content');
    }
}
