<?php

namespace App\Livewire;

use App\Constant;
use App\Livewire\Partials\Header;
use App\Models\Product;
use App\Service\CartService;
use App\Traits\WithAddToCart;
use Livewire\Component;

class DetailProductPage extends Component
{
    use WithAddToCart;

    public Product $product;

    public $relatedProducts;

    public int $quantity = 0;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $productCategories = $this->product->categories->select('id')->pluck('id');
        $this->relatedProducts = Product::select(['products.id', 'products.name', 'products.slug', 'products.images', 'products.price'])
            ->whereHas('categories', fn($query) => $query->whereIn('categories.id', $productCategories))
            ->where('id', '!=', $this->product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $this->quantity = CartService::getQuantity($this->product->id);
    }

    protected function removeToCart()
    {
        $cartItems = CartService::removeCartItem($this->product->id);
        $this->dispatch('updateCartCount', totalCount: count($cartItems))->to(Header::class);
    }

    public function currentAddToCart()
    {
        $this->quantity = 1;
        $totalCount = CartService::addItemToCart($this->product->id);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    public function increment()
    {
        if ($this->quantity === Constant::MAX_PRODUCT) {
            return;
        }
        $this->quantity++;
        CartService::addItemToCart($this->product->id, $this->quantity);
    }

    public function decrement()
    {
        if ($this->quantity <= 1) {
            $this->removeToCart();
            $this->quantity = 0;
        } else {
            $this->quantity--;
            CartService::addItemToCart($this->product->id, $this->quantity);
        }
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
