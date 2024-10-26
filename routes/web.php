<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\Page\AboutController;
use App\Http\Controllers\Page\BlogController;
use App\Http\Controllers\Page\CartController;
use App\Http\Controllers\Page\CheckOutController;
use App\Http\Controllers\Page\ContactController;
use App\Http\Controllers\Page\HomeCotroller;
use App\Http\Controllers\Page\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\MainCotroller;
use App\Http\Controllers\Page\DetailsController;
use App\Http\Controllers\Page\WishlistController;
use App\Http\Middleware\EnsureUserIsAuthenticated;


Route::get('admin/user/login', [LoginController::class, 'index'])->name('login');

Route::post('admin/user/login/store',[LoginController::class, 'store']);
Route::post('admin/user/register/store',[RegisterController::class, 'register'])->name('register');

#pages
Route::prefix('/')->group(function () {
    Route::get('/', [HomeCotroller::class, 'index'])->name('index');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/blog', [BlogController::class, 'details'])->name('blog.details');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/{id}', [CartController::class, 'add'])->name('cart.add');

    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/search', [ShopController::class, 'search'])->name('search');
    Route::get('/product-details/{id}', [DetailsController::class, 'details'])->name('details');
    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');

    #wishlist
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('/store/{id}', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::get('/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    });
    


});



Route::middleware('admin')->group(function () {
     
    Route::prefix('admin')->group(function(){

        Route::get('/main', [MainController::class , 'index'])->name('admin');
        // Route::get('', [MainController::class , 'index']);

        #menu
        Route::prefix('menu')->group(function(){
            Route::get('add', [MenuController::class , 'create'])->name('menu.add');
            Route::post('add', [MenuController::class , 'store'])->name('menu.store');
            Route::get('list', [MenuController::class , 'index'])->name('menu.list');
            Route::get('{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
           // Định nghĩa route cho cập nhật menu
            Route::put('{id}', [MenuController::class, 'update'])->name('menu.update');
            Route::delete('{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

        });
        
        #product
        Route::prefix('product')->group(function(){
            Route::get('add', [ProductController::class , 'create'])->name('product.add');
            Route::post('add', [ProductController::class , 'store'])->name('product.store');
            Route::get('list', [ProductController::class , 'index'])->name('product.list');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('{id}', [ProductController::class, 'destroy'])->name('product.destroy');

        });

    
        #slider
        Route::prefix('slider')->group(function(){
            Route::get('add', [SliderController::class , 'create'])->name('slider.add');
            Route::post('add', [SliderController::class , 'store'])->name('slider.store');
            Route::get('list', [SliderController::class , 'index'])->name('slider.list');
            Route::get('{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
            Route::put('{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::delete('{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

        });


        #upload img
        Route::post('upload/services', [UploadController::class, 'update'])->name('upload.services');


    });
});
