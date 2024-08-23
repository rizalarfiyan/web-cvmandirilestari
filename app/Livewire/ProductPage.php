<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\WithAddToCart;

#[Title("Produk")]
class ProductPage extends Component
{
    use WithPagination, WithAddToCart;

    #[Url]
    public array $category = [];

    #[Url]
    public bool $isFeatured = false;

    #[Url]
    public bool $onSale = false;

    #[Url]
    public string $sortOrder = "latest-asc";

    public array $groupCategories;

    public array $statusFilters = [
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

    public array $sortOrders = [
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

    public function mount()
    {
        self::initCart();
        $categories = Category::all()->select(['id', 'name', 'slug'])->sortBy('name');
        $this->groupCategories = $categories->groupBy(function (array $item) {
            return Str::upper(Str::substr($item['name'], 0, 1));
        })->toArray();
    }

    public function render()
    {
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

        $products = $products->simplePaginate(Constant::LIMIT_PAGINATION_PRODUCT, ['id', 'name', 'slug', 'images', 'price', 'is_featured', 'on_sale', 'in_stock']);
        $this->products = $products;
        self::updateStateProduct();

        return view('livewire.product-page', [
            'links' => $products->links(),
        ]);
    }
}
