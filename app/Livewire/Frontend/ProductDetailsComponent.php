<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Models\WishList;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Auth;
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
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');
    }
    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->dispatch('refreshCartIconComponent');
        Session()->flash('success_message', 'Product added in cart');
        return redirect()->route('cart');
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->dispatch('refreshCartIconComponent');

    }
    public function AddToWishlist($product_id, $product_name, $product_price)
    {
        // Add the product to the wishlist cart
        // Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        // Insert the product into the wish_lists table

        if (Auth::check()) {
            (new WishList(['user_id' => Auth::user()->id, 'product_id' => $product_id]))->save();
            return redirect()->route('user.wishlist');
        } else {
            // Handle the case where the user is not authenticated
        }
    }
    public function RemoveFromWishlist($product_id)
    {
        // Remove the product from the wishlist cart
        // Cart::instance('wishlist')->remove($product_id);

        // Remove the product from the wish_lists table
        if (Auth::check()) {
            WishList::where('user_id', Auth::user()->id)->where('product_id', $product_id)->delete();
            return redirect()->route('user.wishlist');
        } else {
            // Handle the case where the user is not authenticated
        }
    }
    public function render()
    {

        $productData = Product::where('slug', $this->slug)->first();

        $productGallery = ProductGallery::where('product_id', $productData->id)->get();

        return view('livewire.frontend.product-details-component',compact('productData','productGallery'));
    }
}
