<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimelinePhaseResource\Pages;
use App\Models\TimelinePhase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TimelinePhaseResource extends Resource
{
    protected static ?string $model = TimelinePhase::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Tənzimləmələr';

    protected static ?string $navigationLabel = 'Zaman xətti';

    protected static ?string $modelLabel = 'Mərhələ';

    protected static ?string $pluralModelLabel = 'Zaman xətti';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_az')
                    ->label('Başlıq')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('date_label')
                    ->label('Tarix etiketi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('actual_date')
                    ->label('Faktiki tarix'),
                Forms\Components\Textarea::make('description_az')
                    ->label('Təsvir')
                    ->rows(2),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'done' => 'Tamamlanıb',
                        'active' => 'Aktiv',
                        'upcoming' => 'Gələcək',
                    ])
                    ->required()
                    ->default('upcoming'),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_az')
                    ->label('Başlıq')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_label')
                    ->label('Tarix'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'done' => 'success',
                        'active' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'done' => 'Tamamlanıb',
                        'active' => 'Aktiv',
                        default => 'Gələcək',
                    }),
                Tables\Columns\TextColumn::make('description_az')
                    ->label('Təsvir')
                    ->limit(50),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimelinePhases::route('/'),
            'create' => Pages\CreateTimelinePhase::route('/create'),
            'edit' => Pages\EditTimelinePhase::route('/{record}/edit'),
        ];
    }
}
