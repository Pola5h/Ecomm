<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishListComponent extends Component
{
    protected $listeners = [
        'refreshWishlistComponent' => '$refresh'
    ];

    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        if (Auth::check()) {
            WishList::where('user_id', Auth::user()->id)->where('product_id', $product_id)->delete();
        } 
        Session()->flash('success_message', 'Product added in cart');
        return redirect()->route('cart');
    }
    public function destroy($id)
    {
        WishList::findOrFail($id)->delete();
        $this->dispatch('refreshWishlistComponent');
        return redirect()->route('wishlist');

    }
    public function render()
    {
        $WishlistData =  WishList::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wish-list-component',compact('WishlistData'));
    }
}
