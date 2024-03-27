<?php

namespace App\Filament\Resources\ProductHomeResource\Pages;

use App\Filament\Resources\ProductHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductHome extends EditRecord
{
    protected static string $resource = ProductHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
