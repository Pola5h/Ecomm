<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    protected $listeners =['refreshCartComponent'=>'$refresh'];


    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');

    }
    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        $this->dispatch('refreshCartIconComponent');

        session()->flash('success_message', 'Item has been removed!');
    }
    public function clear()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('refreshCartIconComponent');

        session()->flash('success_message', 'The Cart is empty!');
    }

    public function render()
    {
        return view('livewire.frontend.cart-component');
    }
}
