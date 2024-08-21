<?php

namespace App\Livewire\Partials;

use App\Service\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public int $totalCount = 0;

    public function mount()
    {
        $this->totalCount = count(CartService::getCartItemFromCookie());
    }

    #[On('updateCartCount')]
    public function updateCartCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    public function render()
    {
        return view('livewire.partials.header');
    }
}
