<?php

namespace App\Filament\Resources\TimelinePhaseResource\Pages;

use App\Filament\Resources\TimelinePhaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimelinePhases extends ListRecords
{
    protected static string $resource = TimelinePhaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
