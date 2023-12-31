<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CheckOutComponent extends Component
{
    protected $listeners =['refreshCheckoutComponent'=>'$refresh'];

    public function render()
    {


        $UserData = Auth::user();
        return view('livewire.frontend.check-out-component', compact('UserData'));
    }
}
