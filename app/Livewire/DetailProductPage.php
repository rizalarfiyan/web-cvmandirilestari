<?php

namespace App\Livewire;

use App\Models\Product;
use App\Service\CartService;
use App\Traits\WithAddToCart;
use Livewire\Component;

class DetailProductPage extends Component
{
    use WithAddToCart;

    public Product $product;

    public $relatedProducts;

    public $categories;

    public int $quantity = 0;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $this->categories = $this->product->categories->select(['id', 'name', 'slug'])->toArray();
        $this->relatedProducts = Product::select(['id', 'name', 'slug', 'images', 'price', 'is_featured', 'on_sale', 'in_stock'])
            ->whereHas('categories', fn($query) => $query->whereIn('categories.id', collect($this->categories)->pluck('id')))
            ->where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $this->quantity = CartService::getQuantity($this->product->id);
    }

    public function increment()
    {
        $val = self::baseIncrementProduct($this->product->id);
        $this->quantity = $val->quantity;
    }

    public function decrement()
    {
        $val = self::baseDecrementProduct($this->product->id);
        $this->quantity = $val->quantity;
    }

    public function render()
    {
        $images = collect($this->product->images)
            ->map(fn($image) => asset('storage/' . $image))
            ->transform(fn($item) => "'" . $item . "'")
            ->implode(",");
        return view('livewire.detail-product-page', [
            'images' => "[$images]"
        ])->title("Produk {$this->product->name}");
    }
}
