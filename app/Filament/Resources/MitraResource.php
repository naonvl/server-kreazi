<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MitraResource\Pages;
use App\Models\Mitra;
use App\Models\Membership;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class MitraResource extends Resource
{
    protected static ?string $model = Mitra::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-group';
    protected static ?string $navigationLabel = 'Mitra';
    protected static ?int $navigationSort = 3;

    //view only role -> 2 (mitra)
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 2);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->placeholder('Nama Pengguna')
                    ->maxLength(100),
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->placeholder('Username')
                    ->maxLength(100),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->revealable()
                    ->placeholder('Password')
                    ->minLength(6)
                    ->maxLength(100),
                // Select::make('role')
                //     ->options([
                //         '1' => 'Admin',
                //         '2' => 'Mitra',
                //         '3' => 'Customer'
                //     ])
                //     ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->placeholder('Email')
                    ->required()
                    ->unique(column: 'email', ignoreRecord: true)
                    ->maxLength(100),
                Select::make('member')
                    ->label('Membership')
                    ->relationship('membership','name'),
                    // ->options(Membership::all()->pluck('name', 'id')),
                    // ->searchable(),
                Forms\Components\TextInput::make('subdomain')
                    ->required()
                    ->label('Subdomain Mitra')
                    ->placeholder('Subdomain Mitra')
                    ->maxLength(100),
                // Forms\Components\TextInput::make('logoUrl')
                //     ->required()
                //     ->maxLength(100),
                FileUpload::make('logoUrl')
                    ->label('Logo')
                    ->disk('public')
                    ->directory('akun'),
                    // ->visibility('private'),
                Forms\Components\TextInput::make('phone')
                    ->label('No Whatsapp')
                    ->placeholder('Isi Nomor Whatsapp')
                    ->tel()
                    ->numeric()
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('kota')
                    ->label('Kota')
                    ->placeholder('Kota Tinggal')
                    ->required()
                    ->maxLength(100),
                 Select::make('status')
                    ->options([
                        '0' => 'Unactive',
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
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('role')
                //     ->searchable()
                //     ->formatStateUsing(fn (string $state): string => match ($state) {
                //         '1' => 'Admin',
                //         '2' => 'Mitra',
                //         '3' => 'Customer'
                //     }),
                Tables\Columns\TextColumn::make('membership.name')
                    ->label('Membership')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subdomain')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logoUrl'),
                    // ->directory('akun'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        '0' => 'Unactive',
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
            'index' => Pages\ListMitras::route('/'),
            'create' => Pages\CreateMitra::route('/create'),
            'edit' => Pages\EditMitra::route('/{record}/edit'),
        ];
    }
}
