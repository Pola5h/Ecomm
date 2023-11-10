<?php

namespace App\Livewire\Frontend;
use Gloudemans\Shoppingcart\Facades\Cart;

use Livewire\Component;

class CartIconComponent extends Component
{

    protected $listeners =['refreshCartIconComponent'=>'$refresh'];

    public function destroy($id)
    {
        Cart::remove($id);
        $this->dispatch('refreshCartComponent');

        session()->flash('success_message', 'Item has been removed!');
    }
    public function render()
    {
        return view('livewire.frontend.cart-icon-component');
    }
}
