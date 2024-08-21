<?php

namespace App\Livewire;

use App\Livewire\Partials\Header;
use App\Models\Product;
use App\Service\CartService;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Products")]
class ProductPage extends Component
{
    use WithPagination;

    const ITEM_PER_PAGE = 8;

    public function addToCart($productId)
    {
        $totalCount = CartService::addItemToCart($productId);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    public function render()
    {
        $products = Product::cursorPaginate(self::ITEM_PER_PAGE, ['id', 'name', 'slug', 'images', 'price']);
        return view('livewire.product-page', [
            'products' => $products,
        ]);
    }
}
