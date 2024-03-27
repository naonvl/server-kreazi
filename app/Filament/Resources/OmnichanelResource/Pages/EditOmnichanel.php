<?php

namespace App\Filament\Resources\OmnichanelResource\Pages;

use App\Filament\Resources\OmnichanelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOmnichanel extends EditRecord
{
    protected static string $resource = OmnichanelResource::class;

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
