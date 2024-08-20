<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Products")]
class ProductPage extends Component
{
    public function render()
    {
        return view('livewire.product-page');
    }
}
