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
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeResource extends Resource
{
    protected static ?string $model = Tipe::class;

    // protected static ?string $navigationGroup = 'Seting Aplikasi';
    protected static ?string $navigationIcon = 'heroicon-c-list-bullet';
    protected static ?string $navigationLabel = 'Tipe / Kategori';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    // ->unique(column: 'name'),
                    ->unique(column: 'name', ignoreRecord: true),
                Select::make('status')
                    ->options([
                        '0' => 'Draft',
                        '1' => 'Active'
                    ])
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
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Draft',
                        '1' => 'Active'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->mutateRecordDataUsing(function (array $data): array {
                    $data['tipe_id'] = auth()->id();
             
                    return $data;
                }),
                Tables\Actions\DeleteAction::make(),
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
