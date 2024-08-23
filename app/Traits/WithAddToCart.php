<?php

namespace App\Traits;

use App\Livewire\Partials\Header;
use App\Service\CartService;
use Illuminate\Support\Collection;

trait WithAddToCart
{
    protected Collection $cartItems;

    public $products;

    protected function initCart(): void
    {
        $cartItems = CartService::getCartItemFromCookie();
        $this->cartItems = self::groupByProductId($cartItems);
    }

    protected function initCartPage(): void
    {
        $this->cartItems = collect(CartService::getCartItemFromCookie());
    }

    protected function groupByProductId($cartItems): Collection
    {
        return collect($cartItems)->keyBy('product_id');
    }

    protected function updateStateProduct(): void
    {
        $this->products = $this->products->map(function ($product) {
            $product->quantity = collect($this->cartItems ?? [])->get($product->id, ['quantity' => 0])->quantity ?? 0;
            return (object) $product;
        });
    }

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
            'totalPrice' => CartService::calculateTotalPrice(collect($cartItems)),
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
            'totalPrice' => CartService::calculateTotalPrice(collect($cartItems)),
        ];
    }

    public function incrementProduct(int $productId): void
    {
        $val = $this->baseIncrementProduct($productId);
        $this->cartItems = self::groupByProductId($val->cartItems);
    }

    public function decrementProduct(int $productId): void
    {
        $val = $this->baseDecrementProduct($productId);
        $this->cartItems = self::groupByProductId($val->cartItems);
    }
}
