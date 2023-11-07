<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;

class ShopComponent extends Component
{
    use WithPagination;


    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
    Session()->flash('success_message','Product added in cart');
    return redirect()->route('cart');
    }


    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.frontend.shop-component', compact('products'));
    }
}
