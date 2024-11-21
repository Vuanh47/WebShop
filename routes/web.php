<?php

use App\Http\Controllers\Admin\AdminOderController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\Page\AboutController;
use App\Http\Controllers\Page\BlogController;
use App\Http\Controllers\Page\CartController;
use App\Http\Controllers\Page\CheckOutController;
use App\Http\Controllers\Page\ContactController;
use App\Http\Controllers\Page\HomeCotroller;
use App\Http\Controllers\Page\OrderDetailController;
use App\Http\Controllers\Page\OrderHistory;
use App\Http\Controllers\Page\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\MainCotroller;
use App\Http\Controllers\Page\DetailsController;
use App\Http\Controllers\Page\WishlistController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Page\OrderController;
use App\Http\Controllers\Page\OrderHistoryController;

Route::prefix('admin/user')->group(function(){
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login/store',[LoginController::class, 'store'])->name('admin.store');
    Route::post('register/store', [RegisterController::class, 'register'])->name('admin.register');
});
#pages
Route::prefix('/')->group(function () {
        // Authentication Routes
        Route::post('register', [CustomerController::class, 'register'])->name('register');
        Route::post('login/store', [CustomerController::class, 'store'])->name('store');
        Route::get('login', [CustomerController::class, 'login'])->name('login');
        Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

        // Home Routes
        Route::get('/', [HomeCotroller::class, 'index'])->name('index');
        Route::get('/about', [AboutController::class, 'index'])->name('about');

        // Shop Routes
        Route::get('/shop', [ShopController::class, 'index'])->name('shop');
        Route::get('/search', [ShopController::class, 'search'])->name('search');
        Route::get('/product-details/{id}', [DetailsController::class, 'details'])->name('details');

      

        Route::post('coupon', [CartController::class, 'coupon'])->name('coupon');

        // Blog Routes
        Route::get('/blog-details/{productId?}', [BlogController::class, 'details'])->name('blog.details');


        // Checkout Routes
        Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');

        Route::prefix('order')->group(function () {
            Route::post('/', [OrderController::class, 'index'])->name('order');
            Route::get('/', [OrderController::class, 'index'])->name('order');

            Route::post('/store', [OrderController::class, 'store'])->name('order.add');
        });

        Route::get('/order_details/{id}', [OrderDetailController::class, 'index'])->name('order_details');


    #wishlist
   Route::middleware('cus')->group(function () {
        Route::prefix('wishlist')->group(function () {
            Route::get('/', [WishlistController::class, 'index'])->name('wishlist');
            Route::post('/store/{id}', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');
            Route::delete('/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
        });
        Route::prefix('cart')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('cart');
            Route::post('/{id}', [CartController::class, 'store'])->name('cart.add');
            Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.delete');
            Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        });
        // web.php (routes)
        Route::post('product-details/comment', [BlogController::class, 'store'])->name('comment.add');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');

        Route::get('/order_history', [OrderHistoryController::class, 'index'])->name('order_history');

    });
});


Route::middleware('admin')->group(function () {
     
    Route::prefix('admin')->group(function(){

        Route::get('/main', [MainController::class , 'index'])->name('admin');

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

           #Vouchers
           Route::prefix('voucher')->group(function(){
            Route::get('add', [VoucherController::class , 'create'])->name('voucher.add');
            Route::post('add', [VoucherController::class , 'store'])->name('voucher.store');
            Route::get('list', [VoucherController::class , 'index'])->name('voucher.list');
            Route::get('{id}/edit', [VoucherController::class, 'edit'])->name('voucher.edit');
            Route::put('{id}', [VoucherController::class, 'update'])->name('voucher.update');
            Route::delete('{id}', [VoucherController::class, 'destroy'])->name('voucher.destroy');
          


        });


        #Oder
        Route::prefix('order')->group(function(){
            Route::get('/', [AdminOderController::class, 'index'])->name('order.list');
            Route::post('/{id}/next-status', [AdminOderController::class, 'nextStatus'])->name('orders.nextStatus');
            Route::post('/{id}', [AdminOderController::class, 'detail'])->name('order.detail');

        });

        #upload img
        Route::post('upload/services', [UploadController::class, 'update'])->name('upload.services');



    });
});
