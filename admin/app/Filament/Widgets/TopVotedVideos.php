<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopVotedVideos extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Ən çox səs alan videolar';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Video::query()
                    ->where('status', 'approved')
                    ->withCount('votes')
                    ->withAvg('juryScores', 'average')
                    ->orderByDesc('votes_count')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq'),
                Tables\Columns\TextColumn::make('author_full_name')
                    ->label('Müəllif'),
                Tables\Columns\TextColumn::make('category.name_az')
                    ->label('Kateqoriya')
                    ->badge(),
                Tables\Columns\TextColumn::make('votes_count')
                    ->label('Səslər')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jury_scores_avg_average')
                    ->label('Jury ort.')
                    ->numeric(2)
                    ->default('-'),
            ])
            ->paginated(false);
    }
}
