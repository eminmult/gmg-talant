<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AllowedDomainResource\Pages;
use App\Models\AllowedDomain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AllowedDomainResource extends Resource
{
    protected static ?string $model = AllowedDomain::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Tənzimləmələr';

    protected static ?string $navigationLabel = 'İcazəli domenlər';

    protected static ?string $modelLabel = 'Domen';

    protected static ?string $pluralModelLabel = 'İcazəli domenlər';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('domain')
                    ->label('Domen')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->placeholder('global-media.az')
                    ->helperText('Yalnız domen adı daxil edin (@ işarəsi olmadan)'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktiv')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('domain')
                    ->label('Domen')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktiv')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Yaradılıb')
                    ->dateTime('d.m.Y')
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAllowedDomains::route('/'),
            'create' => Pages\CreateAllowedDomain::route('/create'),
            'edit' => Pages\EditAllowedDomain::route('/{record}/edit'),
        ];
    }
}
