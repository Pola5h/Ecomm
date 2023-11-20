<?php

namespace App\Livewire\Frontend;

use App\Models\Hero;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\WishList;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;

class IndexComponent extends Component
{

    protected $listeners = [
        'productRemovedFromWishlist' => '$refresh',
        'productAddedToWishlist' => '$refresh'
    ];
    public function CartStore($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        // Notification::send($users,new NewBooking($data));
        Session()->flash('success_message', 'Product added in cart');
        return redirect()->route('cart');
    }

    public function AddToWishlist($product_id, $product_name, $product_price)
    {
        // Add the product to the wishlist cart
        // Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        // Insert the product into the wish_lists table

        if (Auth::check()) {
            (new WishList(['user_id' => Auth::user()->id, 'product_id' => $product_id]))->save();
            return redirect()->route('user.wishlist');
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
        } 
    }

    public function render()
    {
        $testimonials = Testimonial::get();
        $heroData = Hero::get();
        $products = Product::where('featured', 1)->get();
        $topCategory = Category::withCount('products')->get();
        return view('livewire.frontend.index-component', compact('products', 'topCategory','testimonials','heroData'));
    }
}
