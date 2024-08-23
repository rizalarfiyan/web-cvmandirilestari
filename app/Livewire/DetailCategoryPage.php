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

    public bool $hasMore = false;

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)->firstOrFail();
        self::initCart();
        $this->products = $this->category->products()->simplePaginate(Constant::LIMIT_PAGINATION_PRODUCT, ['products.id', 'products.name', 'products.slug', 'products.images', 'products.price', 'products.is_featured', 'products.on_sale', 'products.in_stock']);
        $this->hasMore = $this->products->hasMorePages();
    }

    public function render()
    {
        self::updateStateProduct();
        return view('livewire.detail-category-page')->title("Kategori {$this->category->name}");
    }
}
