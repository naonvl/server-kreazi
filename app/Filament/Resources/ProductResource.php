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

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('is_dropship')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('dropship_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('mitra')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('customer')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(500),
                Forms\Components\TextInput::make('tipe')
                    ->required()
                    ->numeric(),
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
                Forms\Components\TextInput::make('id_template')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(50)
                    ->default('Draft'),
                Forms\Components\DateTimePicker::make('create_date')
                    ->required(),
                Forms\Components\DateTimePicker::make('modified_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('is_dropship')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dropship_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mitra')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipe')
                    ->numeric()
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
                Tables\Columns\TextColumn::make('id_template')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('create_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('modified_date')
                    ->dateTime()
                    ->sortable(),
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
