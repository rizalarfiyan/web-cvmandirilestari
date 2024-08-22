<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\HomePage::class)->name('home');

Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/', App\Livewire\CategoryPage::class)->name('list');
    Route::get('/{slug}', App\Livewire\DetailCategoryPage::class)->name('detail');
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', App\Livewire\ProductPage::class)->name('list');
    Route::get('/{slug}', App\Livewire\DetailProductPage::class)->name('detail');
});

Route::get('/cart', App\Livewire\CartPage::class)->name('cart');
