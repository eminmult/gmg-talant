<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewApplication extends ViewRecord
{
    protected static string $resource = ApplicationResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Ərizə məlumatları')
                    ->schema([
                        Infolists\Components\TextEntry::make('first_name')->label('Ad'),
                        Infolists\Components\TextEntry::make('last_name')->label('Soyad'),
                        Infolists\Components\TextEntry::make('company.name')->label('Şirkət'),
                        Infolists\Components\TextEntry::make('department')->label('Departament'),
                        Infolists\Components\TextEntry::make('title')->label('Başlıq'),
                        Infolists\Components\TextEntry::make('description')->label('Təsvir'),
                        Infolists\Components\TextEntry::make('video_original_name')->label('Video fayl adı'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'warning',
                            }),
                        Infolists\Components\TextEntry::make('rejection_reason')->label('Rədd səbəbi')->visible(fn ($record) => $record->status === 'rejected'),
                        Infolists\Components\TextEntry::make('created_at')->label('Göndərilmə tarixi')->dateTime('d.m.Y H:i'),
                        Infolists\Components\TextEntry::make('reviewed_at')->label('Baxılma tarixi')->dateTime('d.m.Y H:i'),
                    ])->columns(2),
            ]);
    }
}
