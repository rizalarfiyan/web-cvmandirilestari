<?php

namespace App\Livewire;

use App\Service\CartService;
use App\Traits\WithAddToCart;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Keranjang")]
class CartPage extends Component
{
    use WithAddToCart;

//    public array $cartItems = [];

    public int $totalPrice = 0;

    public function mount()
    {
        self::initCartPage();
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
    }

    public function remove($productId): void
    {
        $this->cartItems = collect(CartService::removeCartItem($productId));
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
        self::updateCartCount(count($this->cartItems));
    }

    public function increment(int $productId): void
    {
        $val = self::baseIncrementProduct($productId);
        $this->cartItems = collect($val->cartItems);
        $this->totalPrice = $val->totalPrice;
    }

    public function decrement(int $productId): void
    {
        $val = self::baseDecrementProduct($productId);
        $this->cartItems = collect($val->cartItems);
        $this->totalPrice = $val->totalPrice;
    }

    public function render()
    {
        return view('livewire.cart-page', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
