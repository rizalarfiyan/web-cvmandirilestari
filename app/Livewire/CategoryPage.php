<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Kategori")]
class CategoryPage extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::all(['id', 'name', 'slug', 'image']);
    }

    public function render()
    {
        return view('livewire.category-page');
    }
}
