<?php

namespace App\Filament\Resources\ProductHomeResource\Pages;

use App\Filament\Resources\ProductHomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductHomes extends ListRecords
{
    protected static string $resource = ProductHomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
