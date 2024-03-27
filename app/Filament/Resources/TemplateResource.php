<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemplateResource\Pages;
use App\Filament\Resources\TemplateResource\RelationManagers;
use App\Models\Tipe;
use App\Models\Template;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TemplateResource extends Resource
{
    protected static ?string $model = Template::class;

    protected static ?string $navigationGroup = 'Order';
    protected static ?string $navigationIcon = 'heroicon-m-pencil-square';
    protected static ?string $navigationLabel = 'Template';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Template')
                    ->required()
                    ->maxLength(100),
                Select::make('tipe')
                    ->required()
                    ->options(Tipe::where('status', 1)->pluck('name', 'id')),
                Forms\Components\TextInput::make('template')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->label('Logo')
                    ->disk('public')
                    ->directory('akun'),
                    // ->visibility('private'),
                Select::make('user')
                    ->label('Pembuat Template')
                    // ->searchable()
                    ->options(User::where('role', 1)->pluck('name', 'id')),
                Select::make('status')
                    ->options([
                        '0' => 'Draft',
                        '1' => 'Publish'
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
                Tables\Columns\TextColumn::make('jenis.name')
                    ->label('Tipe')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                    // ->searchable(),
                Tables\Columns\TextColumn::make('pembuat.name')
                    ->label('Pembuat Template')
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
                    }),
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
            'index' => Pages\ListTemplates::route('/'),
            'create' => Pages\CreateTemplate::route('/create'),
            'edit' => Pages\EditTemplate::route('/{record}/edit'),
        ];
    }
}
