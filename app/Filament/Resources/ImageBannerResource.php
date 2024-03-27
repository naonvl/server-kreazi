<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageBannerResource\Pages;
use App\Filament\Resources\ImageBannerResource\RelationManagers;
use App\Models\ImageBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class ImageBannerResource extends Resource
{
    protected static ?string $model = ImageBanner::class;

    protected static ?string $navigationGroup = 'Seting Aplikasi';
    protected static ?string $navigationIcon = 'heroicon-c-photo';
    protected static ?string $navigationLabel = 'Gambar Banner Home';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('logoUrl')
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
                Tables\Columns\ImageColumn::make('url')
                    ->label('Gambar Banner'),
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
            'index' => Pages\ListImageBanners::route('/'),
            'create' => Pages\CreateImageBanner::route('/create'),
            'edit' => Pages\EditImageBanner::route('/{record}/edit'),
        ];
    }
}
