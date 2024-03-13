<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeResource\Pages;
use App\Filament\Resources\TipeResource\RelationManagers;
use App\Models\Tipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeResource extends Resource
{
    protected static ?string $model = Tipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(10),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListTipes::route('/'),
            'create' => Pages\CreateTipe::route('/create'),
            'edit' => Pages\EditTipe::route('/{record}/edit'),
        ];
    }
}
