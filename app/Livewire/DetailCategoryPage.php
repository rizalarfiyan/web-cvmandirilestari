<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Category;
use App\Traits\WithAddToCart;
use Livewire\Component;

class DetailCategoryPage extends Component
{
    use WithAddToCart;

    public Category $category;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $products = $this->category->products()->paginate(Constant::LIMIT_PAGINATION_PRODUCT, ['products.id', 'products.name', 'products.slug', 'products.images', 'products.price']);
        return view('livewire.detail-category-page', [
            'products' => $products,
        ])->title("Kategori {$this->category->name}");
    }
}
