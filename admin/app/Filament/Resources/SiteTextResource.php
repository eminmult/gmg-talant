<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteTextResource\Pages;
use App\Models\SiteText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteTextResource extends Resource
{
    protected static ?string $model = SiteText::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationGroup = 'Məzmun';

    protected static ?string $navigationLabel = 'Sayt mətnləri';

    protected static ?string $modelLabel = 'Mətn';

    protected static ?string $pluralModelLabel = 'Sayt mətnləri';

    protected static ?int $navigationSort = 10;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('Açar')
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\Select::make('section')
                    ->label('Bölmə')
                    ->options([
                        'hero' => 'Hero',
                        'nav' => 'Naviqasiya',
                        'timeline' => 'Zaman xətti',
                        'videos' => 'Videolar',
                        'rules' => 'Qaydalar',
                        'apply' => 'Ərizə forması',
                        'footer' => 'Alt hissə',
                        'modal' => 'Modallar',
                        'jury' => 'Münsiflər',
                    ])
                    ->disabled(),
                Forms\Components\TextInput::make('label')
                    ->label('Təsvir')
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\Textarea::make('value')
                    ->label('Mətn')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->label('Bölmə')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('key')
                    ->label('Açar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('Təsvir')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('value')
                    ->label('Mətn')
                    ->searchable()
                    ->limit(60)
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section')
                    ->label('Bölmə')
                    ->options([
                        'hero' => 'Hero',
                        'nav' => 'Naviqasiya',
                        'timeline' => 'Zaman xətti',
                        'videos' => 'Videolar',
                        'rules' => 'Qaydalar',
                        'apply' => 'Ərizə forması',
                        'footer' => 'Alt hissə',
                        'modal' => 'Modallar',
                        'jury' => 'Münsiflər',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('section');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteTexts::route('/'),
            'edit' => Pages\EditSiteText::route('/{record}/edit'),
        ];
    }
}
