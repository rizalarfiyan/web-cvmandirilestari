<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Category;
use App\Models\Product;
use App\Traits\WithAddToCart;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Beranda")]
class HomePage extends Component
{
    use WithAddToCart;

    public $categories;

    public function mount()
    {
        self::initCart();
        $this->products = Product::select(['products.id', 'products.name', 'products.slug', 'products.images', 'products.price', 'products.is_featured', 'products.on_sale', 'products.in_stock'])
            ->inRandomOrder()
            ->limit(Constant::LIMIT_PAGINATION_PRODUCT)
            ->get();

        $this->categories = Category::select(['id', 'name', 'slug', 'image'])
            ->inRandomOrder()
            ->limit(12)
            ->get();
    }

    public function render()
    {
        self::updateStateProduct();
        return view('livewire.home-page');
    }
}
