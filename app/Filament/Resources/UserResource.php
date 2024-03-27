<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Membership;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // protected static ?string $navigationGroup = 'Seting Aplikasi';
    protected static ?string $navigationIcon = 'heroicon-c-user-group';
    protected static ?string $navigationLabel = 'User Admin';
    protected static ?int $navigationSort = 2;

    //view only role -> 1 (admin)
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 1);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->placeholder('Nama Admin')
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
                // Select::make('member')
                //     ->label('Membership')
                //     ->relationship('membership','name'),
                //     // ->options(Membership::all()->pluck('name', 'id')),
                Forms\Components\TextInput::make('phone')
                    ->label('No Whatsapp')
                    ->placeholder('Isi Nomor Whatsapp')
                    ->tel()
                    ->numeric()
                    ->required()
                    ->maxLength(20),
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
                // Tables\Columns\TextColumn::make('membership.name')
                //     ->label('Membership')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
