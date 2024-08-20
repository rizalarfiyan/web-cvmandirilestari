<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Products")]
class ProductPage extends Component
{
    public function render()
    {
        $products = Product::all()->toArray();
        return view('livewire.product-page', [
            'products' => $products,
        ]);
    }
}
