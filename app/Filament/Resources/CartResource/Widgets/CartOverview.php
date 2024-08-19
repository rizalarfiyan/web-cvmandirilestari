<?php

namespace App\Filament\Resources\CartResource\Widgets;

use App\Constant;
use App\Models\Cart;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class CartOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('New Cart', Cart::query()->where('state', Constant::CART_STATUS_NEW)->count()),
            Stat::make('Cart Processing', Cart::query()->where('state', Constant::CART_STATUS_PROCESSING)->count()),
            Stat::make('Cart Canceled', Cart::query()->where('state', Constant::CART_STATUS_CANCELED)->count()),
            Stat::make('Average Price', Number::currency(Cart::query()->avg('total_price'), 'IDR', 'id')),
        ];
    }
}
