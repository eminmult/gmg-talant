<?php

namespace App\Filament\Resources\RuleGroupResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RulesRelationManager extends RelationManager
{
    protected static string $relationship = 'rules';

    protected static ?string $title = 'Qaydalar';

    protected static ?string $modelLabel = 'Qayda';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('icon')
                    ->label('İkon (SVG və ya mətn)')
                    ->rows(3)
                    ->placeholder('SVG kod və ya qısa mətn (1, 2, HD ...)')
                    ->helperText('SVG kod və ya rəqəm/qısa mətn daxil edin'),
                Forms\Components\TextInput::make('title')
                    ->label('Başlıq')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Təsvir')
                    ->required()
                    ->rows(2),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktiv')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('İkon')
                    ->limit(10),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Təsvir')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktiv')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
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
}
