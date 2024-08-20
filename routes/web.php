<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\HomePage::class)->name('home');
Route::get('/categories', App\Livewire\CategoryPage::class)->name('category');
Route::get('/products', App\Livewire\ProductPage::class)->name('product');
Route::get('/cart', App\Livewire\CartPage::class)->name('cart');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
