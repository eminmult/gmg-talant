<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use App\Models\JuryMember;
use App\Models\Video;
use App\Models\Vote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Təsdiqlənmiş videolar', Video::where('status', 'approved')->count())
                ->icon('heroicon-o-video-camera')
                ->color('success'),
            Stat::make('Ümumi səslər', Vote::count())
                ->icon('heroicon-o-hand-thumb-up')
                ->color('info'),
            Stat::make('Gözləyən ərizələr', Application::where('status', 'pending')->count())
                ->icon('heroicon-o-document-text')
                ->color('warning'),
            Stat::make('Aktiv münsiflər', JuryMember::where('is_active', true)->count())
                ->icon('heroicon-o-star')
                ->color('danger'),
        ];
    }
}
