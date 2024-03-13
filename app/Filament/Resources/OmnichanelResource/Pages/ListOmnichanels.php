<?php

namespace App\Filament\Resources\OmnichanelResource\Pages;

use App\Filament\Resources\OmnichanelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOmnichanels extends ListRecords
{
    protected static string $resource = OmnichanelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
