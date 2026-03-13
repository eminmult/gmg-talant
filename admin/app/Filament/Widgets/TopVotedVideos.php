<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopVotedVideos extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Reytinq — Yekun nəticələr (60% Münsiflər + 40% Səsvermə)';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Video::query()
                    ->where('status', 'approved')
                    ->withCount('votes')
                    ->withAvg('juryScores', 'average')
                    ->orderByRaw('(
                        0.6 * COALESCE((SELECT AVG(average) FROM jury_scores WHERE jury_scores.video_id = videos.id), 0)
                        + 0.4 * (CAST((SELECT COUNT(*) FROM votes WHERE votes.video_id = videos.id) AS REAL)
                            / MAX((SELECT MAX(cnt) FROM (SELECT COUNT(*) as cnt FROM votes GROUP BY video_id)), 1)) * 10
                    ) DESC')
            )
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq'),
                Tables\Columns\TextColumn::make('author_full_name')
                    ->label('Müəllif'),
                Tables\Columns\TextColumn::make('category.name_az')
                    ->label('Kateqoriya')
                    ->badge(),
                Tables\Columns\TextColumn::make('votes_count')
                    ->label('Səslər'),
                Tables\Columns\TextColumn::make('jury_scores_avg_average')
                    ->label('Münsiflər')
                    ->numeric(2)
                    ->default('-'),
                Tables\Columns\TextColumn::make('final_score')
                    ->label('Yekun bal')
                    ->getStateUsing(function (Video $record) {
                        static $maxVotes = null;
                        if ($maxVotes === null) {
                            $maxVotes = Video::where('status', 'approved')
                                ->withCount('votes')
                                ->get()
                                ->max('votes_count') ?: 1;
                        }

                        $juryAvg = $record->jury_scores_avg_average ?? 0;
                        $publicScore = ($record->votes_count / $maxVotes) * 10;

                        return number_format(0.6 * $juryAvg + 0.4 * $publicScore, 2);
                    })
                    ->color('success')
                    ->weight('bold')
                    ->size('lg'),
            ])
            ->paginated(false);
    }
}
