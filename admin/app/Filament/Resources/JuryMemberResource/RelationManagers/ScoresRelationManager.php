<?php

namespace App\Filament\Resources\JuryMemberResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ScoresRelationManager extends RelationManager
{
    protected static string $relationship = 'scores';

    protected static ?string $title = 'Qiymətlər';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('video.title')
                    ->label('Video')
                    ->limit(30),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarix')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
