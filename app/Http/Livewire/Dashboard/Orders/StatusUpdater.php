<?php

namespace App\Http\Livewire\Dashboard\Orders;

use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class StatusUpdater extends Component
{

    use LivewireAlert;

    public $order;
    public int $status_id = 0;

    public array $statusArray = [];

    public function updatedStatusId(): void
    {

        if (in_array($this->status_id, $this->statusArray)) {

            if($this->order->status != Order::STATUS_CANCELLED) {

                if($this->status_id == Order::STATUS_CANCELLED) {

                    $items = $this->order->orderItems;

                    foreach ($items as $item) {
                        $product = $item->product;
                        if($product) {
                            $product->update([
                                'stock' => ($product->stock + $item->quantity)
                            ]);
                        }
                    }

                }

                $this->order->update([
                    'status' => $this->status_id,
                ]);
                $this->alert('success', 'Successfully updated order status.');

            } else {

                $this->status_id = $this->order->status;
                $this->alert('error', 'Cannot change the status of cancelled orders.');
            }

        }
    }

    public function mount(Order $order): void
    {
        $this->order = $order;
        $this->status_id = $order->status;
        $this->statusArray = Order::getStatusAsArray();
    }

    public function render()
    {
        return view('livewire.dashboard.orders.status-updater');
    }
}
