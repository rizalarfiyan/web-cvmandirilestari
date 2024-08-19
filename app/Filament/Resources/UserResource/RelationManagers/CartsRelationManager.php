<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Constant;
use App\Filament\Resources\CartResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CartsRelationManager extends RelationManager
{
    protected static string $relationship = 'carts';

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function canViewForRecord(Model $currentRecord, string $pageClass): bool
    {
        return $currentRecord->role != Constant::ROLE_ADMIN;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
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
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        Constant::CART_PAYMENT_METHOD_CASH => 'Cash',
                        Constant::CART_PAYMENT_METHOD_TRANSFER => 'Transfer',
                    ]),
                Tables\Filters\SelectFilter::make('payment_state')
                    ->options([
                        Constant::CART_PAYMENT_STATUS_PENDING => 'Pending',
                        Constant::CART_PAYMENT_STATUS_SUCCESS => 'Success',
                        Constant::CART_PAYMENT_STATUS_FAILED => 'Failed',
                    ]),
                Tables\Filters\SelectFilter::make('state')
                    ->options([
                        Constant::CART_STATUS_NEW => 'New',
                        Constant::CART_STATUS_PROCESSING => 'Processing',
                        Constant::CART_STATUS_COMPLETED => 'Completed',
                        Constant::CART_STATUS_CANCELED => 'Canceled',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->url(fn ($record) => CartResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-s-eye')
            ]);
    }
}
