<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Colors\Color;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use LaraZeus\Quantity\Components\Quantity;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(64)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', strtolower(Str::slug($state)));
                    })
                    ->columnSpan(2),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(64)
                    ->unique(ignoreRecord: true)
                    ->columnSpan(2),
                Quantity::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(99999),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('Rp.'),
                Forms\Components\Select::make('category')
                    ->required()
                    ->searchable()
                    ->debounce()
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->minItems(1)
                    ->maxItems(6)
                    ->columnSpan(2),
                Forms\Components\RichEditor::make('description')
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
                    ])
                    ->required()
                    ->columnSpanFull()
                    ->minLength(40),
                Forms\Components\FileUpload::make('images')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])
                    ->directory('products')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('4:3')
                    ->multiple()
                    ->reorderable()
                    ->panelLayout('grid')
                    ->columnSpanFull()
                    ->minSize(32)
                    ->maxSize(1024 * 3)
                    ->minFiles(1)
                    ->maxFiles(5),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('Rp. ', 0, 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('Watch')
                    ->icon('heroicon-o-globe-alt')
                    ->iconButton()
                    ->tooltip('Preview Product')
                    ->color(Color::Blue)
                    ->url(fn(Product $product) => "/product/{$product['slug']}")
                    ->openUrlInNewTab(),
                Tables\Actions\ViewAction::make()->iconButton()->tooltip('View Product'),
                Tables\Actions\EditAction::make()->iconButton()->tooltip('Edit Product'),
                Tables\Actions\DeleteAction::make()->iconButton()->tooltip('Delete Product'),
                Tables\Actions\RestoreAction::make()->iconButton()->tooltip('Restore Product'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
