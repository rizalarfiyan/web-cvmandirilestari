<?php

namespace App\Livewire;

use App\Constant;
use App\Livewire\Partials\Header;
use App\Models\Category;
use App\Models\Product;
use App\Service\CartService;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Produk")]
class ProductPage extends Component
{
    use WithPagination;

    #[Url]
    public $category = [];

    #[Url]
    public $isFeatured = false;

    #[Url]
    public $onSale = false;

    #[Url]
    public $sortOrder = "latest-asc";

    public function addToCart($productId)
    {
        $totalCount = CartService::addItemToCart($productId);
        $this->dispatch('updateCartCount', totalCount: $totalCount)->to(Header::class);
    }

    public function render()
    {
        $categories = Category::all()->select(['id', 'name', 'slug'])->sortBy('name');
        $groupCategories = $categories->groupBy(function (array $item) {
            return Str::upper(Str::substr($item['name'], 0, 1));
        });

        $products = Product::query();

        if (!empty($this->category)) {
            $products->whereHas('categories', function ($query) {
                $query->whereIn('categories.id', $this->category);
            });
        }

        if ($this->isFeatured) {
            $products->where('is_featured', true);
        }

        if ($this->onSale) {
            $products->where('on_sale', true);
        }

        if ($this->sortOrder === 'latest-desc') {
            $products->orderBy('id', 'desc');
        } elseif ($this->sortOrder === 'price-asc') {
            $products->orderBy('price');
        } elseif ($this->sortOrder === 'price-desc') {
            $products->orderBy('price', 'desc');
        } elseif ($this->sortOrder === 'name-asc') {
            $products->orderBy('name');
        } elseif ($this->sortOrder === 'name-desc') {
            $products->orderBy('name', 'desc');
        } else {
            $products->orderBy('id');
        }

        $statusFilters = [
            [
                'id' => 'status-filter-featured',
                'name' => 'Produk Unggulan',
                'description' => 'Produk yang sedang populer dan banyak diminati',
                'model' => 'isFeatured',
            ],
            [
                'id' => 'status-fitler-on-sale',
                'name' => 'Produk Diskon',
                'description' => 'Produ produk yang sedang diskon',
                'model' => 'onSale',
            ]
        ];

        $sortOrders = [
            [
                'id' => 'latest-asc',
                'name' => 'Produk Terbaru',
            ],
            [
                'id' => 'latest-desc',
                'name' => 'Produk Terlama',
            ],
            [
                'id' => 'name-asc',
                'name' => 'Nama A-Z',
            ],
            [
                'id' => 'name-desc',
                'name' => 'Nama Z-A',
            ],
            [
                'id' => 'price-asc',
                'name' => 'Harga Terendah',
            ],
            [
                'id' => 'price-desc',
                'name' => 'Harga Tertinggi',
            ],
        ];

        return view('livewire.product-page', [
            'products' => $products->cursorPaginate(Constant::LIMIT_PAGINATION_PRODUCT, ['id', 'name', 'slug', 'images', 'price']),
            'groupCategories' => $groupCategories,
            'statusFilters' => $statusFilters,
            'sortOrders' => $sortOrders,
        ]);
    }
}
