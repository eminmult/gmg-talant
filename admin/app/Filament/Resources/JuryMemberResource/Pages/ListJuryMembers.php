<?php

namespace App\Filament\Resources\JuryMemberResource\Pages;

use App\Filament\Resources\JuryMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJuryMembers extends ListRecords
{
    protected static string $resource = JuryMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
