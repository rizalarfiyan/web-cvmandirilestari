<?php

namespace App\Providers;

use App\View\Components\Card\Category;
use App\View\Components\Card\Product;
use App\View\Components\EmptyState;
use App\View\Components\HeadingTitle;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::component('heading-title', HeadingTitle::class);
        Blade::component('empty-state', EmptyState::class);
        Blade::component('card-category', Category::class);
        Blade::component('card-product', Product::class);
    }
}
