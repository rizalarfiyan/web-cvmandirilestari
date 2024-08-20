<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Categories")]
class CategoryPage extends Component
{
    public function render()
    {
        return view('livewire.category-page', [
            'categories' => Category::all(),
        ]);
    }
}
