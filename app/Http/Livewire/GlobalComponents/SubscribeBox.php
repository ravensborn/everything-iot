<?php

namespace App\Http\Livewire\GlobalComponents;

use App\Models\SubscriberList;
use Livewire\Component;

class SubscribeBox extends Component
{

    public int $type = 0;

    public string $messageContext = '';
    public string $messageType = '';

    public string $email = '';

    public function checkThrottle(): bool
    {

        $lastSubscriber = SubscriberList::latest()->first();

        if(!$lastSubscriber) {

            return true;
        }

        $timeDifference = $lastSubscriber->created_at->diffInSeconds(now());

        if ($timeDifference > 60) {
            return true;
        }

        $this->messageContext = 'Please wait at least a minute before submitting.';
        $this->messageType = 'danger';

        return false;
    }

    public function add()
    {
         if($this->checkThrottle()) {

             $this->messageContext = '';

             $validated = $this->validate([
                 'email' => 'required|email|unique:subscriber_list,email'
             ]);

             $subscriberList = new SubscriberList;
             $subscriberList->create($validated);

             $this->messageContext = 'Successfully added to subscriber list.';
             $this->messageType = 'success';
         }
    }

    public function mount($type = 1)
    {
        $this->type = $type;
    }

    public function render()
    {
        if ($this->type == 1) {
            return view('livewire.global-components.subscribe-box-1');
        }

        if ($this->type == 2) {
            return view('livewire.global-components.subscribe-box-2');
        }

        return view('livewire.global-components.subscribe-box-1');

    }
}
