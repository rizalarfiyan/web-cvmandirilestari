<?php

namespace App\Livewire;

use App\Constant;
use App\Models\Cart;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Riwayat")]
class HistoryPage extends Component
{
    use WithPagination;

    #[Url]
    public string $sortOrder = "latest-asc";

    #[Url]
    public string $paymentMethod = "all";

    #[Url]
    public string $paymentStatus = "all";

    #[Url]
    public string $cartStatus = "all";

    public array $paymentMethodFilters = [
        [
            'name' => 'Semua',
            'value' => 'all',
        ],
        [
            'name' => 'Bayar Langsung',
            'value' => Constant::CART_PAYMENT_METHOD_CASH,
        ],
        [
            'name' => 'Transfer Bank',
            'value' => Constant::CART_PAYMENT_METHOD_TRANSFER,
        ]
    ];

    public array $paymentStatusFilters = [
        [
            'name' => 'Semua',
            'value' => 'all',
        ],
        [
            'name' => 'Tertunda',
            'value' => Constant::CART_PAYMENT_STATUS_PENDING,
        ],
        [
            'name' => 'Berhasil',
            'value' => Constant::CART_PAYMENT_STATUS_SUCCESS,
        ],
        [
            'name' => 'Gagal',
            'value' => Constant::CART_PAYMENT_STATUS_FAILED,
        ]
    ];

    public array $cartStatusFilters = [
        [
            'name' => 'Semua',
            'value' => 'all',
        ],
        [
            'name' => 'Pesanan Baru',
            'value' => Constant::CART_STATUS_NEW,
        ],
        [
            'name' => 'Diproses',
            'value' => Constant::CART_STATUS_PROCESSING,
        ],
        [
            'name' => 'Berhasil',
            'value' => Constant::CART_STATUS_COMPLETED,
        ],
        [
            'name' => 'Gagal',
            'value' => Constant::CART_STATUS_CANCELED,
        ]
    ];

    public array $sortOrders = [
        [
            'id' => 'latest-asc',
            'name' => 'Riwayat Terbaru',
        ],
        [
            'id' => 'latest-desc',
            'name' => 'Riwayat Terlama',
        ],
        [
            'id' => 'product-asc',
            'name' => 'Produk Terendah',
        ],
        [
            'id' => 'product-desc',
            'name' => 'Produk Tertinggi',
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

    public function render()
    {
        $cart = Cart::query();
        $cart->select(['id', 'total_price', 'payment_method', 'payment_state', 'state'])
            ->withCount('items as total_product');

        $user = auth()->user();
        if (!$user->can('admin')) {
            $cart->where('user_id', $user->id);
        }

        switch ($this->paymentMethod) {
            case Constant::CART_PAYMENT_METHOD_CASH:
            case Constant::CART_PAYMENT_METHOD_TRANSFER:
                $cart->where('payment_method', $this->paymentMethod);
                break;
        }

        switch ($this->paymentStatus) {
            case Constant::CART_PAYMENT_STATUS_PENDING:
            case Constant::CART_PAYMENT_STATUS_SUCCESS:
            case Constant::CART_PAYMENT_STATUS_FAILED:
                $cart->where('payment_state', $this->paymentStatus);
                break;
        }

        switch ($this->cartStatus) {
            case Constant::CART_STATUS_NEW:
            case Constant::CART_STATUS_PROCESSING:
            case Constant::CART_STATUS_COMPLETED:
            case Constant::CART_STATUS_CANCELED:
                $cart->where('state', $this->cartStatus);
                break;
        }

        if ($this->sortOrder === 'latest-desc') {
            $cart->orderBy('id', 'desc');
        } elseif ($this->sortOrder === 'product-asc') {
            $cart->orderBy('total_product');
        } elseif ($this->sortOrder === 'product-desc') {
            $cart->orderBy('total_product', 'desc');
        } elseif ($this->sortOrder === 'price-asc') {
            $cart->orderBy('total_price');
        } elseif ($this->sortOrder === 'price-desc') {
            $cart->orderBy('total_price', 'desc');
        } else {
            $cart->orderBy('id');
        }

        $carts = $cart->simplePaginate(Constant::LIMIT_PAGINATION_CART);

        return view('livewire.history-page', [
            'carts' => $carts,
        ]);
    }
}
