<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AuditLog extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Audit log';
    protected static ?string $navigationGroup = 'Manage';
    protected static ?int $navigationSort = 4;
    protected static string $view = 'filament.pages.audit-log';

    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('Administrator') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Activity::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable()
                    ->default('System'),
                Tables\Columns\BadgeColumn::make('log_name')
                    ->label('Area')
                    ->colors([
                        'primary' => 'prices',
                        'success' => 'highlights',
                        'warning' => 'settings',
                        'danger'  => 'users',
                    ]),
                Tables\Columns\TextColumn::make('description')
                    ->label('Action / Description')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Target Model')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('log_name')
                    ->label('Area')
                    ->options([
                        'default'    => 'General',
                        'prices'     => 'Prices',
                        'highlights' => 'Highlights',
                        'settings'   => 'Settings',
                        'users'      => 'Users',
                    ]),
            ])
            ->actions([])
            ->bulkActions([]);
    }
}

