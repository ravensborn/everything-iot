<?php

namespace App\Http\Livewire\Users\Store;

use App\Models\Order;
use Illuminate\Contracts\Auth\Authenticatable;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersShow extends Component
{

    use WithPagination;

    public $order;
    public $orderItems;
    public Authenticatable $user;

    public function mount($order)
    {
        $this->user = auth()->user();
        $this->order = $this->user->orders()->find($order);
        $this->orderItems = $this->order->orderItems;
    }


    public function render()
    {
        return view('livewire.users.store.orders-show')->extends('layouts.store')->section('content');
    }
}
