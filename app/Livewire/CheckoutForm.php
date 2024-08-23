<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Cart;
use App\Service\CartService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CheckoutForm extends Component
{
    #[Rule(['required', 'in:cash,transfer'])]
    public string $paymentMethod = Constant::CART_PAYMENT_METHOD_CASH;

    #[Rule(['nullable', 'string', 'max:255'])]
    public ?string $notes = null;

    public array $paymentMethods = [
        [
            'name' => 'Bayar langsung',
            'value' => Constant::CART_PAYMENT_METHOD_CASH,
            'description' => 'Anda bisa membayar secara langsung. Lebih cepat dan lebih mudah.'
        ],
        [
            'name' => 'Transfer Bank',
            'value' => Constant::CART_PAYMENT_METHOD_TRANSFER,
            'description' => 'Anda bisa membayar dengan transfer bank, ke rekening <b>MANDIRI</b>: <b>1234567890</b> a/n <b>PT. CV Mandiri Lestari</b>.'
        ],
    ];

    public function render()
    {
        return view('livewire.checkout-form');
    }

    public function save()
    {
        $this->validate();

        $cartItems = CartService::getCartItemFromCookie();

        $cart = new Cart();
        $cart->user_id = auth()->id();
        $cart->payment_method = $this->paymentMethod;
        $cart->notes = $this->notes;
        $cart->state = Constant::CART_STATUS_NEW;
        $cart->payment_state = Constant::CART_PAYMENT_STATUS_PENDING;
        $cart->total_price = CartService::calculateTotalPrice(collect($cartItems));
        $cart->save();

        $arrCartItems = collect($cartItems)->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total_price' => $item->total_price,
            ];
        })->toArray();
        $cart->items()->createMany($arrCartItems);

        CartService::clearCartItems();

        $this->reset();
        $this->dispatch('close-modal');
        $this->redirect('/');
    }
}
