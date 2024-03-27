<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\User;
use App\Models\Tipe;
use App\Models\Template;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Order';
    protected static ?string $navigationIcon = 'heroicon-m-tag';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('is_dropship')
                    ->label('Produk Dropship?')
                    ->required()
                    ->options([
                        '0' => 'Tidak',
                        '1' => 'Iya'
                    ])
                    ->required(),
                Select::make('id_template')
                    ->label('Pilih Template')
                    // ->required()
                    ->options(Template::where('status', 1)->pluck('name', 'id')),
                Select::make('mitra')
                    ->label('Pilih Mitra')
                    // ->required()
                    ->options(User::where('role', 2)->pluck('name', 'id')),
                Select::make('customer')
                    ->label('Pilih Customer')
                    // ->required()
                    ->options(User::where('role', 3)->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(500),
                Select::make('tipe')
                    ->required()
                    ->options(Tipe::where('status', 1)->pluck('name', 'id')),
                Forms\Components\TextInput::make('ukuran')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('harga_jual')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('harga_beli')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('discount_jual')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('discount_beli')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options([
                        '0' => 'Draft',
                        '1' => 'Publish'
                    ])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('is_dropship')
                    ->label('Produk Dropship')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Tidak',
                        '1' => 'Ya'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success',
                    }),
                Tables\Columns\ImageColumn::make('template_gbr.thumbnail')
                    ->label('Template')
                    ->sortable(),
                Tables\Columns\TextColumn::make('penjual.name')
                    ->label('Mitra')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pembeli.name')
                    ->label('Customer')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis.name')
                    ->label('Tipe')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ukuran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga_jual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_beli')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_jual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_beli')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Draft',
                        '1' => 'Publish'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
