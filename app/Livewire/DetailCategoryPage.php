<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class DetailCategoryPage extends Component
{
    protected string $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $category = Category::where('slug', $this->slug)->firstOrFail();
        return view('livewire.detail-category-page', [
            'category' => $category,
            'products' => $category->products->select(['id', 'name', 'slug', 'price', 'images'])->toArray(),
        ]);
    }
}
