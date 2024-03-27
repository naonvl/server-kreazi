<?php

namespace App\Filament\Resources\ProductHomeResource\Pages;

use App\Filament\Resources\ProductHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductHome extends CreateRecord
{
    protected static string $resource = ProductHomeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
