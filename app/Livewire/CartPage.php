<?php

namespace App\Livewire;

use App\Livewire\Partials\Header;
use App\Service\CartService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Keranjang")]
class CartPage extends Component
{
    public array $cartItems = [];

    public int $totalPrice = 0;

    public function mount()
    {
        $this->cartItems = CartService::getCartItemFromCookie();
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
    }

    public function removeItem($productId)
    {
        $this->cartItems = CartService::removeCartItem($productId);
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
        $this->dispatch('updateCartCount', totalCount: count($this->cartItems))->to(Header::class);
    }

    public function incrementItem($productId)
    {
        $this->cartItems = CartService::incrementQuantityToCartItem($productId);
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
    }

    public function decrementItem($productId)
    {
        $this->cartItems = CartService::decrementQuantityToCartItem($productId);
        $this->totalPrice = CartService::calculateTotalPrice($this->cartItems);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
