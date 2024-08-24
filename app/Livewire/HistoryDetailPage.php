<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class HistoryDetailPage extends Component
{
    public $cart;

    public function mount(int $id)
    {
        $cart = Cart::select('id', 'total_price', 'payment_method', 'payment_state', 'state', 'notes', 'created_at')
            ->with(['items' => function ($query) {
                $query->select('id', 'cart_id', 'product_id', 'quantity', 'unit_price', 'total_price')
                    ->with(['product' => function ($query) {
                        $query->select('id', 'name', 'slug', 'images');
                    }]);
            }]);

        $user = auth()->user();
        if (!$user->can('admin')) {
            $cart->where('user_id', $user->id);
        }

        $this->cart = $cart->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.history-detail-page');
    }
}
