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

    protected static ?string $navigationGroup = 'Seting Aplikasi';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Omichanel';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->directory('akun'),
                    // ->visibility('private'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Gambar Omnichanel'),
                    // ->directory('akun'),
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
