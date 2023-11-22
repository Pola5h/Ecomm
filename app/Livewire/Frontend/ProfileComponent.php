<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileComponent extends Component
{
    public function render()
    {
        $orderData = Order::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.profile-component',compact('orderData'));
    }
}
