<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Middleware\EnsureUserIsAuthenticated;


Route::get('admin/user/login', [LoginController::class, 'index'])->name('login');

Route::post('admin/user/login/store',[LoginController::class, 'store']);


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
        });

        #upload
        Route::post('upload/services', [UploadController::class, 'update'])->name('upload.services');


    });
});
