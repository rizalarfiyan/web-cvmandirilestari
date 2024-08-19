<?php

namespace App\Filament\Resources\CartResource\Pages;

use App\Constant;
use App\Filament\Resources\CartResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListCarts extends ListRecords
{
    protected static string $resource = CartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CartResource\Widgets\CartOverview::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            Constant::CART_STATUS_NEW => Tab::make()->query(fn ($query) => $query->where('state', Constant::CART_STATUS_NEW)),
            Constant::CART_STATUS_PROCESSING => Tab::make()->query(fn ($query) => $query->where('state', Constant::CART_STATUS_PROCESSING)),
            Constant::CART_STATUS_COMPLETED => Tab::make()->query(fn ($query) => $query->where('state', Constant::CART_STATUS_COMPLETED)),
            Constant::CART_STATUS_CANCELED => Tab::make()->query(fn ($query) => $query->where('state', Constant::CART_STATUS_CANCELED)),
        ];
    }
}
