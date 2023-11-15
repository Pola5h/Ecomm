<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;

class ProfileComponent extends Component
{
    public function render()
    {
        $orderData = Order::all();
        return view('livewire.frontend.profile-component',compact('orderData'));
    }
}
