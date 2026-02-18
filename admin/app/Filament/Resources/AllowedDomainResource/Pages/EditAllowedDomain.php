<?php

namespace App\Filament\Resources\AllowedDomainResource\Pages;

use App\Filament\Resources\AllowedDomainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAllowedDomain extends EditRecord
{
    protected static string $resource = AllowedDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
