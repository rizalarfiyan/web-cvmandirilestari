<?php

namespace App\Filament\Widgets;

use App\Constant;
use App\Filament\Resources\CartResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Str;

class LatestCarts extends BaseWidget
{
    protected string|int|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CartResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Cart ID')
                    ->sortable()
                    ->formatStateUsing(function(Tables\Columns\TextColumn $column, $state) {
                        if (blank($state)) {
                            return null;
                        }

                        return "CT".Str::of($state)->padLeft(5, '0');
                    }),
                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->money('IDR', 0, 'id'),
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Constant::CART_PAYMENT_METHOD_CASH => 'primary',
                        Constant::CART_PAYMENT_METHOD_TRANSFER => 'info'
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        Constant::CART_PAYMENT_METHOD_CASH => 'heroicon-s-currency-dollar',
                        Constant::CART_PAYMENT_METHOD_TRANSFER => 'heroicon-s-credit-card',
                    }),
                Tables\Columns\TextColumn::make('payment_state')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Constant::CART_PAYMENT_STATUS_PENDING => 'info',
                        Constant::CART_PAYMENT_STATUS_SUCCESS => 'success',
                        Constant::CART_PAYMENT_STATUS_FAILED => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        Constant::CART_PAYMENT_STATUS_PENDING => 'heroicon-s-clock',
                        Constant::CART_PAYMENT_STATUS_SUCCESS => 'heroicon-s-check-badge',
                        Constant::CART_PAYMENT_STATUS_FAILED => 'heroicon-s-x-circle',
                    }),
                Tables\Columns\TextColumn::make('state')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Constant::CART_STATUS_NEW => 'info',
                        Constant::CART_STATUS_PROCESSING => 'primary',
                        Constant::CART_STATUS_COMPLETED => 'success',
                        Constant::CART_STATUS_CANCELED => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        Constant::CART_STATUS_NEW => 'heroicon-s-sparkles',
                        Constant::CART_STATUS_PROCESSING => 'heroicon-m-arrow-path',
                        Constant::CART_STATUS_COMPLETED => 'heroicon-s-check-badge',
                        Constant::CART_STATUS_CANCELED => 'heroicon-s-x-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->url(fn ($record) => CartResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-s-eye')
            ]);
    }
}
