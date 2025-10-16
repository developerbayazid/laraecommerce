<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__.'/auth.php';
