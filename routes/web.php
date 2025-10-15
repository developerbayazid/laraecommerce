<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/category', [AdminController::class, 'index'])->name('admin.category.add');
    Route::post('/category', [AdminController::class, 'store'])->name('admin.category.store');
    Route::get('/categories', [AdminController::class, 'view'])->name('admin.category.view');
    Route::get('/category/delete/{id}', [AdminController::class, 'destroy'])->name('admin.category.destroy');
});

require __DIR__.'/auth.php';
