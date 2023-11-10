<?php

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
Route::get('/checkout', \App\Livewire\Frontend\CheckoutComponent::class)->name('checkout');
Route::get('/product/{slug}', \App\Livewire\Frontend\ProductDetailsComponent::class)->name('product');





Route::get('forbidden', function () {
    return view('error.forbidden');
})->name('forbidden');
Route::get('/dashboard', function () {
    $user = auth()->user();
    return $user->user_type === 1 ? view('admin.index') : ($user->user_type === 2 ? redirect(route('home')) : view('welcome'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'check_user:1'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('category', \App\Http\Controllers\backend\CategoryController::class);
    Route::resource('brand', \App\Http\Controllers\backend\BrandController::class);
    Route::resource('product', \App\Http\Controllers\backend\ProductController::class);
    Route::get('product/gallery/{id}', [\App\Http\Controllers\backend\ProductController::class, 'gallery'])->name('gallery');

    Route::post('product/gallery/store', [\App\Http\Controllers\backend\ProductController::class, 'galleryStore'])->name('gallery.store');
    Route::post('product/gallery/upload', [\App\Http\Controllers\backend\ProductController::class, 'galleryUpload'])->name('gallery.upload');
    Route::delete('product/gallery/delete/{id}', [\App\Http\Controllers\backend\ProductController::class, 'galleryDelete'])->name('gallery.delete');
});

Route::group(['middleware' => ['auth', 'check_user:2'],  'as' => 'user.'], function () {
});




// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
