<?php

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    return $user->user_type === 1 ? view('admin.index') : ($user->user_type === 2 ? redirect(route('home')) : view('welcome'));
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
    Route::post('/update-hero-status', function (\Illuminate\Http\Request $request) {


        dd($request->all());
        $id = $request->input('id');
        $status = $request->input('status');

        $data = Hero::find($id);

        if (!$data) {
            toastr()->error('Status not uptaded');

            return redirect()->route('admin.hero.index');
        }

        $data->status = $status;
        $data->save();
        toastr()->success('Status successfully');

        return redirect()->route('admin.hero.index');
    })->name('update-hero-status');
});

Route::group(['middleware' => ['auth', 'check_user:2'], 'prefix' => 'user',  'as' => 'user.'], function () {
    Route::get('profile', \App\Livewire\Frontend\ProfileComponent::class)->name('profile');
    Route::post('profile/update', [\App\Livewire\Frontend\AccountSettingComponent::class, 'updateAccount'])->name('profile.update');
    Route::post('updateImage', [\App\Http\Controllers\frontend\UpdateImageController::class, 'updateProfilePhoto'])->name('updateProfilePhoto');
    Route::get('/wishlist', \App\Livewire\Frontend\WishListComponent::class)->name('wishlist');
    Route::get('/checkout', \App\Livewire\Frontend\CheckOutComponent::class)->name('checkout');
    Route::get('/order-details', \App\Livewire\Frontend\OrderDetailsComponent::class)->name('order.details');
    Route::post('payment/post', [\App\Http\Controllers\frontend\PaymentController::class, 'PaymentPost'])->name('payment.post');
});






require __DIR__ . '/auth.php';
