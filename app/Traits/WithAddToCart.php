<?php

namespace App\Traits;

use App\Livewire\Partials\Header;
use App\Service\CartService;

trait WithAddToCart
{
    public function addToCart($productId)
    {
        $totalCount = CartService::addItemToCart($productId);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }
}
