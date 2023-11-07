<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{


    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }
    public function destroy($id)
    {
        Cart::remove($id);
        session()->flash('success_message', 'Item has been removed!');
    }
    public function clear()
    {
        Cart::destroy();
        session()->flash('success_message', 'The Cart is empty!');
    }

    public function render()
    {
        return view('livewire.frontend.cart-component');
    }
}
