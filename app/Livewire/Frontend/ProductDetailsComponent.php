<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use App\Models\ProductGallery;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductDetailsComponent extends Component
{
    protected $listeners =['refreshProductDetailsComponent'=>'$refresh'];


    public $slug;
    public function mount($slug)
    {

        $this->slug = $slug;
    }
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');
    }
    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->dispatch('refreshCartIconComponent');
        Session()->flash('success_message', 'Product added in cart');
        return redirect()->route('cart');
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');

    }
    public function render()
    {

        $productData = Product::where('slug', $this->slug)->first();

        $productGallery = ProductGallery::where('product_id', $productData->id)->get();

        return view('livewire.frontend.product-details-component',compact('productData','productGallery'));
    }
}
