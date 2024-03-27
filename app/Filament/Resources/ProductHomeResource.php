<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductHomeResource\Pages;
use App\Filament\Resources\ProductHomeResource\RelationManagers;
use App\Models\ProductHome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductHomeResource extends Resource
{
    protected static ?string $model = ProductHome::class;

    protected static ?string $navigationGroup = 'Seting Aplikasi';
    protected static ?string $navigationIcon = 'heroicon-c-tag';
    protected static ?string $navigationLabel = 'Produk Home';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_product')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('id_product')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProductHomes::route('/'),
            'create' => Pages\CreateProductHome::route('/create'),
            'edit' => Pages\EditProductHome::route('/{record}/edit'),
        ];
    }
}
