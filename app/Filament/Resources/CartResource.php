<?php

namespace App\Filament\Resources;

use App\Constant;
use App\Filament\Resources\CartResource\Pages;
use App\Filament\Resources\CartResource\RelationManagers;
use App\Models\Cart;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use LaraZeus\Quantity\Components\Quantity;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Customer')
                            ->required()
                            ->searchable()
                            ->debounce()
                            ->preload()
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->whereNot('role', Constant::ROLE_ADMIN),
                            ),
                        Forms\Components\RichEditor::make('notes')
                            ->toolbarButtons([
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ])->columnSpan(3),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\ToggleButtons::make('payment_method')
                            ->required()
                            ->inline()
                            ->options([
                                Constant::CART_PAYMENT_METHOD_CASH => 'Cash',
                                Constant::CART_PAYMENT_METHOD_TRANSFER => 'Transfer',
                            ])
                            ->colors([
                                Constant::CART_PAYMENT_METHOD_CASH => 'primary',
                                Constant::CART_PAYMENT_METHOD_TRANSFER => 'info',
                            ])
                            ->icons([
                                Constant::CART_PAYMENT_METHOD_CASH => 'heroicon-s-currency-dollar',
                                Constant::CART_PAYMENT_METHOD_TRANSFER => 'heroicon-s-credit-card',
                            ])
                            ->default(Constant::CART_PAYMENT_METHOD_CASH),
                        Forms\Components\ToggleButtons::make('payment_state')
                            ->required()
                            ->inline()
                            ->options([
                                Constant::CART_PAYMENT_STATUS_PENDING => 'Pending',
                                Constant::CART_PAYMENT_STATUS_SUCCESS => 'Success',
                                Constant::CART_PAYMENT_STATUS_FAILED => 'Failed',
                            ])
                            ->colors([
                                Constant::CART_PAYMENT_STATUS_PENDING => 'info',
                                Constant::CART_PAYMENT_STATUS_SUCCESS => 'success',
                                Constant::CART_PAYMENT_STATUS_FAILED => 'danger',
                            ])
                            ->icons([
                                Constant::CART_PAYMENT_STATUS_PENDING => 'heroicon-s-clock',
                                Constant::CART_PAYMENT_STATUS_SUCCESS => 'heroicon-s-check-badge',
                                Constant::CART_PAYMENT_STATUS_FAILED => 'heroicon-s-x-circle',
                            ])
                            ->default(Constant::CART_PAYMENT_STATUS_PENDING),
                        Forms\Components\ToggleButtons::make('state')
                            ->required()
                            ->inline()
                            ->options([
                                Constant::CART_STATUS_NEW => 'New',
                                Constant::CART_STATUS_PROCESSING => 'Processing',
                                Constant::CART_STATUS_COMPLETED => 'Completed',
                                Constant::CART_STATUS_CANCELED => 'Canceled',
                            ])
                            ->colors([
                                Constant::CART_STATUS_NEW => 'info',
                                Constant::CART_STATUS_PROCESSING => 'primary',
                                Constant::CART_STATUS_COMPLETED => 'success',
                                Constant::CART_STATUS_CANCELED => 'danger',
                            ])
                            ->icons([
                                Constant::CART_STATUS_NEW => 'heroicon-s-sparkles',
                                Constant::CART_STATUS_PROCESSING => 'heroicon-m-arrow-path',
                                Constant::CART_STATUS_COMPLETED => 'heroicon-s-check-badge',
                                Constant::CART_STATUS_CANCELED => 'heroicon-s-x-circle',
                            ])
                            ->default(Constant::CART_STATUS_NEW),
                    ])->columnSpan(1),
                ])->columnSpanFull()->columns(4),

                Forms\Components\Section::make('Cart Items')->schema([
                    Forms\Components\Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->columnSpan(2)
                                ->reactive()
                                ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                    $price = Product::find($state)?->price ?? 0;
                                    $set('quantity', 1);
                                    $set('unit_price', $price);
                                    $set('total_price', $price);
                                }),
                            Quantity::make('quantity')
                                ->required()
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->maxValue(Constant::MAX_PRODUCT)
                                ->columnSpan(1)
                                ->reactive()
                                ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                    $set('total_price', $state * $get('unit_price'));
                                }),
                            Forms\Components\TextInput::make('unit_price')
                                ->required()
                                ->numeric()
                                ->dehydrated()
                                ->readOnly()
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('total_price')
                                ->required()
                                ->numeric()
                                ->dehydrated()
                                ->readOnly()
                                ->columnSpan(1),
                        ])->columns(5),
                    Forms\Components\Placeholder::make('total_price')
                        ->label('Total Price')
                        ->content(function (Forms\Get $get, Forms\Set $set) {
                            $repeaters = $get('items');
                            if (!$repeaters) {
                                return 0;
                            }

                            $total = collect($repeaters)->sum('total_price');
                            $set('total_price', $total);
                            return Number::currency($total, 'IDR', 'id');
                        }),
                    Forms\Components\Hidden::make('total_price')
                        ->default(0),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
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
                Tables\Columns\SelectColumn::make('state')
                    ->options([
                        Constant::CART_STATUS_NEW => 'New',
                        Constant::CART_STATUS_PROCESSING => 'Processing',
                        Constant::CART_STATUS_COMPLETED => 'Completed',
                        Constant::CART_STATUS_CANCELED => 'Canceled',
                    ])
                    ->selectablePlaceholder(false)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name', fn (Builder $query) => $query->whereNot('role', Constant::ROLE_ADMIN))
                    ->searchable()
                    ->preload(),
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
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): array|string|null
    {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'view' => Pages\ViewCart::route('/{record}'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
