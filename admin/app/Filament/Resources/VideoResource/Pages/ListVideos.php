<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use App\Models\Video;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListVideos extends ListRecords
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Hamısı')
                ->icon('heroicon-o-queue-list')
                ->badge(Video::count()),
            'pending' => Tab::make('Moderasiyada')
                ->icon('heroicon-o-clock')
                ->badgeColor('warning')
                ->badge(Video::where('status', 'pending')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'approved' => Tab::make('Aktiv')
                ->icon('heroicon-o-check-circle')
                ->badgeColor('success')
                ->badge(Video::where('status', 'approved')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved')),
            'rejected' => Tab::make('Rədd edilib')
                ->icon('heroicon-o-x-circle')
                ->badgeColor('danger')
                ->badge(Video::where('status', 'rejected')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
}
