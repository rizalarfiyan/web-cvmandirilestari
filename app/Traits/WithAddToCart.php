<?php

namespace App\Traits;

use App\Livewire\Partials\Header;
use App\Service\CartService;

trait WithAddToCart
{
    public function addToCart($productId): void
    {
        $totalCount = CartService::addItemToCart($productId);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    protected function updateCartCount(int $totalCount): void
    {
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    protected function baseIncrementProduct(int $productId): object
    {
        [$quantity, $cartItems] = CartService::incrementQuantityToCartItem($productId);
        if ($quantity === 1) {
            $this->updateCartCount(count($cartItems));
        }
        return (object)[
            'quantity' => $quantity,
            'cartItems' => $cartItems,
            'totalCart' => count($cartItems),
            'totalPrice' => CartService::calculateTotalPrice($cartItems),
        ];
    }

    protected function baseDecrementProduct(int $productId): object
    {
        [$quantity, $cartItems] = CartService::decrementQuantityToCartItem($productId);
        if ($quantity === 0) {
            $this->updateCartCount(count($cartItems));
        }
        return (object)[
            'quantity' => $quantity,
            'cartItems' => $cartItems,
            'totalCart' => count($cartItems),
            'totalPrice' => CartService::calculateTotalPrice($cartItems),
        ];
    }

    public function incrementProduct(int $productId): void
    {
        $this->baseIncrementProduct($productId);
    }

    public function decrementProduct(int $productId): void
    {
        $this->baseDecrementProduct($productId);
    }
}
