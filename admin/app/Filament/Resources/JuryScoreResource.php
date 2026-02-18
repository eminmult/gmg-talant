<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JuryScoreResource\Pages;
use App\Models\JuryScore;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JuryScoreResource extends Resource
{
    protected static ?string $model = JuryScore::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Münsiflər Heyəti';

    protected static ?string $navigationLabel = 'Qiymətlər';

    protected static ?string $modelLabel = 'Qiymət';

    protected static ?string $pluralModelLabel = 'Qiymətlər';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('video.title')
                    ->label('Video')
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('juryMember.name')
                    ->label('Münsif')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skill')
                    ->label('Bacarıq'),
                Tables\Columns\TextColumn::make('originality')
                    ->label('Orijinallıq'),
                Tables\Columns\TextColumn::make('presentation')
                    ->label('Təqdimat'),
                Tables\Columns\TextColumn::make('uniqueness')
                    ->label('Unikallıq'),
                Tables\Columns\TextColumn::make('impact')
                    ->label('Təsir'),
                Tables\Columns\TextColumn::make('average')
                    ->label('Ortalama')
                    ->weight('bold')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarix')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('video_id')
                    ->label('Video')
                    ->relationship('video', 'title'),
                Tables\Filters\SelectFilter::make('jury_member_id')
                    ->label('Münsif')
                    ->relationship('juryMember', 'name'),
            ])
            ->groups([
                Tables\Grouping\Group::make('video.title')
                    ->label('Video'),
                Tables\Grouping\Group::make('juryMember.name')
                    ->label('Münsif'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJuryScores::route('/'),
        ];
    }
}
