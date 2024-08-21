<?php

namespace App\Livewire;

use App\Livewire\Partials\Header;
use App\Models\Product;
use App\Service\CartService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Products")]
class ProductPage extends Component
{
    public function addToCart($productId)
    {
        $totalCount = CartService::addItemToCart($productId);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    public function render()
    {
        $products = Product::all();
        return view('livewire.product-page', [
            'products' => $products,
        ]);
    }
}
