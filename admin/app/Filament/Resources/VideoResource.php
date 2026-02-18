<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Müsabiqə';

    protected static ?string $navigationLabel = 'Videolar';

    protected static ?string $modelLabel = 'Video';

    protected static ?string $pluralModelLabel = 'Videolar';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Əsas məlumatlar')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Başlıq')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('author_first_name')
                                    ->label('Ad')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('author_last_name')
                                    ->label('Soyad')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('initials')
                            ->label('İnisiallar')
                            ->required()
                            ->maxLength(5),
                        Forms\Components\Select::make('company_id')
                            ->label('Şirkət')
                            ->relationship('company', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('department')
                            ->label('Departament')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('duration')
                            ->label('Müddət')
                            ->maxLength(10),
                        Forms\Components\Textarea::make('description')
                            ->label('Təsvir')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Video fayl')
                    ->schema([
                        Forms\Components\FileUpload::make('video_path')
                            ->label('Video (MP4)')
                            ->disk('public')
                            ->directory('videos')
                            ->acceptedFileTypes(['video/mp4'])
                            ->maxSize(512000)
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        Forms\Components\ViewField::make('video_preview')
                            ->label('Önizləmə')
                            ->view('filament.video-preview')
                            ->visible(fn ($record) => $record?->video_path)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Gözləmədə',
                                'approved' => 'Təsdiqlənib',
                                'rejected' => 'Rədd edilib',
                            ])
                            ->required()
                            ->default('pending'),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Təsdiq tarixi'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('author_full_name')
                    ->label('Müəllif')
                    ->searchable(['author_first_name', 'author_last_name']),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Şirkət')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Müddət'),
                Tables\Columns\TextColumn::make('votes_count')
                    ->label('Səslər')
                    ->counts('votes')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jury_scores_avg_average')
                    ->label('Jury ort.')
                    ->avg('juryScores', 'average')
                    ->numeric(2),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'approved' => 'Təsdiqlənib',
                        'rejected' => 'Rədd edilib',
                        default => 'Gözləmədə',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Gözləmədə',
                        'approved' => 'Təsdiqlənib',
                        'rejected' => 'Rədd edilib',
                    ]),
                Tables\Filters\SelectFilter::make('company_id')
                    ->label('Şirkət')
                    ->relationship('company', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Təsdiq et')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Video $record): bool => $record->status !== 'approved')
                    ->action(fn (Video $record) => $record->update([
                        'status' => 'approved',
                        'approved_at' => now(),
                    ])),
                Tables\Actions\Action::make('reject')
                    ->label('Rədd et')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Video $record): bool => $record->status !== 'rejected')
                    ->action(fn (Video $record) => $record->update([
                        'status' => 'rejected',
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VotesRelationManager::class,
            RelationManagers\JuryScoresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
