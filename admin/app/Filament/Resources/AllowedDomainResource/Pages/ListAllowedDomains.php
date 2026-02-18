<?php

namespace App\Filament\Resources\AllowedDomainResource\Pages;

use App\Filament\Resources\AllowedDomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAllowedDomains extends ListRecords
{
    protected static string $resource = AllowedDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
