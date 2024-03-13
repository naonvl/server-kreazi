<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OmnichanelResource\Pages;
use App\Filament\Resources\OmnichanelResource\RelationManagers;
use App\Models\Omnichanel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OmnichanelResource extends Resource
{
    protected static ?string $model = Omnichanel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('logo')
                    ->required()
                    ->maxLength(100),
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
                Tables\Columns\TextColumn::make('logo')
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
            'index' => Pages\ListOmnichanels::route('/'),
            'create' => Pages\CreateOmnichanel::route('/create'),
            'edit' => Pages\EditOmnichanel::route('/{record}/edit'),
        ];
    }
}
