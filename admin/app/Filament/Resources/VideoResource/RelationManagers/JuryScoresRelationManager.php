<?php

namespace App\Filament\Resources\VideoResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class JuryScoresRelationManager extends RelationManager
{
    protected static string $relationship = 'juryScores';

    protected static ?string $title = 'Jury Qiymətləri';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('juryMember.name')
                    ->label('Münsiflər üzvü'),
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
                    ->weight('bold'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
