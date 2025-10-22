<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [ProductController::class, 'single_product'])->name('frontend.product.single');



Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::get('/order/{id}', [OrderController::class, 'view'])->name('order.view');
    Route::get('/order/delete/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/order/update/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');

    Route::get('/order/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function() {
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.add');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/categories', [CategoryController::class, 'view'])->name('admin.category.view');

    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.add');
    Route::post('/product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products', [ProductController::class, 'view'])->name('admin.product.view');

    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/edit/{id}', [ProductController::class, 'update'])->name('admin.product.update');

    Route::post('/products', [ProductController::class, 'search'])->name('admin.product.search');
});

require __DIR__.'/auth.php';
