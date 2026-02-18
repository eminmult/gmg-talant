<?php

namespace App\Filament\Resources\TimelinePhaseResource\Pages;

use App\Filament\Resources\TimelinePhaseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimelinePhase extends EditRecord
{
    protected static string $resource = TimelinePhaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
