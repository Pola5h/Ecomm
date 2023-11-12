<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;

class IndexComponent extends Component
{


    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Session()->flash('success_message', 'Product added in cart');
        return redirect()->route('cart');
    }



    public function render()
    {
        $products = Product::where('featured', 1)->get();
        $topCategory = Category::withCount('products')->get();
        return view('livewire.frontend.index-component', compact('products', 'topCategory'));
    }
}
