<?php

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialShareButtonsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Livewire\Frontend\IndexComponent::class)->name('home');
Route::get('/shop', \App\Livewire\Frontend\ShopComponent::class)->name('shop');
Route::get('/cart', \App\Livewire\Frontend\CartComponent::class)->name('cart');
Route::get('/product/{slug}', \App\Livewire\Frontend\ProductDetailsComponent::class)->name('product');

Route::get('forbidden', function () {
    return view('error.forbidden');
})->name('forbidden');
Route::get('/dashboard', function () {
    $user = auth()->user();

    switch ($user->user_type) {
        case 1:
            return view('admin.index');
        case 2:
            return redirect(route('home'));
        default:
            return view('welcome');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', \App\Livewire\Frontend\SearchComponent::class, 'search')->name('search');


Route::group(['middleware' => ['auth', 'check_user:1'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('category', \App\Http\Controllers\backend\CategoryController::class);
    Route::resource('brand', \App\Http\Controllers\backend\BrandController::class);
    Route::resource('product', \App\Http\Controllers\backend\ProductController::class);
    Route::resource('testimonial', \App\Http\Controllers\backend\TestimonialController::class);
    Route::resource('hero', \App\Http\Controllers\backend\HeroController::class);
    Route::get('product/gallery/{id}', [\App\Http\Controllers\backend\ProductController::class, 'gallery'])->name('gallery');
    Route::post('product/gallery/store', [\App\Http\Controllers\backend\ProductController::class, 'galleryStore'])->name('gallery.store');
    Route::post('product/gallery/upload', [\App\Http\Controllers\backend\ProductController::class, 'galleryUpload'])->name('gallery.upload');
    Route::delete('product/gallery/delete/{id}', [\App\Http\Controllers\backend\ProductController::class, 'galleryDelete'])->name('gallery.delete');
    Route::resource('order', \App\Http\Controllers\backend\OrderController::class);
});

Route::group(['middleware' => ['auth', 'check_user:2'], 'prefix' => 'user',  'as' => 'user.'], function () {
    Route::get('profile', \App\Livewire\Frontend\ProfileComponent::class)->name('profile');
    Route::post('profile/update', [\App\Livewire\Frontend\AccountSettingComponent::class, 'updateAccount'])->name('profile.update');
    Route::post('updateImage', [\App\Http\Controllers\frontend\UpdateImageController::class, 'updateProfilePhoto'])->name('updateProfilePhoto');
    Route::get('/wishlist', \App\Livewire\Frontend\WishListComponent::class)->name('wishlist');
    Route::get('/checkout', \App\Livewire\Frontend\CheckOutComponent::class)->name('checkout');
    Route::get('/order-details', \App\Livewire\Frontend\OrderDetailsComponent::class)->name('order.details');
    Route::post('payment/post', [\App\Http\Controllers\frontend\PaymentController::class, 'PaymentPost'])->name('payment.post');
    Route::get('payment-success', [\App\Http\Controllers\frontend\PaymentController::class, 'paymentSuccess'])->name('success.payment');
    Route::get('cancel-payment', [\App\Http\Controllers\frontend\PaymentController::class, 'paymentCancel'])->name('cancel.payment');
});


// use App\Http\Controllers\frontend\PaymentController;

// Route::controller(PaymentController::class)
//     ->prefix('paypal')
//     ->group(function () {
//         Route::view('payment', 'paypal.index')->name('create.payment');
//         Route::get('handle-payment', 'handlePayment')->name('make.payment');
//         Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
//         Route::get('payment-success', 'paymentSuccess')->name('success.payment');
//     });




require __DIR__ . '/auth.php';
