<?php

namespace App\Filament\Widgets;

use App\Models\JuryMember;
use App\Models\Video;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class JuryProgress extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Münsiflər proqresi';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $totalVideos = Video::where('status', 'approved')->count();

        return $table
            ->query(
                JuryMember::query()
                    ->where('is_active', true)
                    ->withCount('scores')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Münsif'),
                Tables\Columns\TextColumn::make('scores_count')
                    ->label('Qiymətləndirilən')
                    ->formatStateUsing(fn ($state) => "{$state} / {$totalVideos}"),
                Tables\Columns\TextColumn::make('progress')
                    ->label('Proqres')
                    ->state(fn (JuryMember $record) => $totalVideos > 0
                        ? round(($record->scores_count / $totalVideos) * 100) . '%'
                        : '0%'
                    ),
            ])
            ->paginated(false);
    }
}
