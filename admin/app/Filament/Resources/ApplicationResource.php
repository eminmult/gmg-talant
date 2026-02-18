<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use App\Models\Video;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Müsabiqə';

    protected static ?string $navigationLabel = 'Ərizələr';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $modelLabel = 'Ərizə';

    protected static ?string $pluralModelLabel = 'Ərizələr';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Ad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Soyad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Şirkət'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlıq')
                    ->limit(30),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarix')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Gözləmədə',
                        'approved' => 'Təsdiqlənib',
                        'rejected' => 'Rədd edilib',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Təsdiq et')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Application $record): bool => $record->status === 'pending')
                    ->form([
                        Forms\Components\TextInput::make('duration')
                            ->label('Müddət')
                            ->placeholder('3:42')
                            ->required(),
                    ])
                    ->action(function (Application $record, array $data): void {
                        $nameParts = [$record->first_name, $record->last_name];
                        $initials = mb_substr($record->first_name, 0, 1) . mb_substr($record->last_name, 0, 1);

                        $video = Video::create([
                            'title' => $record->title,
                            'author_first_name' => $record->first_name,
                            'author_last_name' => $record->last_name,
                            'initials' => mb_strtoupper($initials),
                            'company_id' => $record->company_id,
                            'department' => $record->department,
                            'duration' => $data['duration'],
                            'description' => $record->description,
                            'video_path' => $record->video_path,
                            'status' => 'approved',
                            'approved_at' => now(),
                        ]);

                        $record->update([
                            'status' => 'approved',
                            'video_id' => $video->id,
                            'reviewed_at' => now(),
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Ərizə təsdiqləndi və video yaradıldı')
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Rədd et')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Application $record): bool => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rədd səbəbi')
                            ->required(),
                    ])
                    ->action(function (Application $record, array $data): void {
                        $record->update([
                            'status' => 'rejected',
                            'rejection_reason' => $data['rejection_reason'],
                            'reviewed_at' => now(),
                        ]);

                        Notification::make()
                            ->success()
                            ->title('Ərizə rədd edildi')
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'view' => Pages\ViewApplication::route('/{record}'),
        ];
    }
}
