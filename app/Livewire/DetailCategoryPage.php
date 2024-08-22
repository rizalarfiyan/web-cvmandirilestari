<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Category;
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
        $products = $category->products()->cursorPaginate(Constant::LIMIT_PAGINATION_PRODUCT, ['products.id', 'products.name', 'products.slug', 'products.images', 'products.price']);
        return view('livewire.detail-category-page', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
