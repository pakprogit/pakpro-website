<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users & roles';
    protected static ?string $navigationGroup = 'Manage';
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('Administrator') ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('User Account')->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('role')
                    ->options([
                        'Administrator' => 'Administrator',
                        'Communications editor' => 'Communications editor',
                        'Price editor' => 'Price editor',
                    ])
                    ->required()
                    ->afterStateUpdated(function ($state, $record) {
                        if ($record && $record->hasRole('Administrator') && $state !== 'Administrator') {
                            if (User::countActiveAdministrators() <= 2) {
                                Notification::make()
                                    ->title('Cannot demote administrator')
                                    ->body('The system requires at least two active administrators at all times.')
                                    ->danger()
                                    ->send();
                            }
                        }
                    }),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active status')
                    ->default(true)
                    ->helperText('Deactivated users cannot log in, but their audit history is preserved.'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn (User $record): string => $record->email)
                    ->searchable()
                    ->sortable()
                    ->label('User'),

                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->colors([
                        'primary' => 'Administrator',
                        'info'    => 'Communications editor',
                        'warning' => 'Price editor',
                    ])
                    ->getStateUsing(function (User $record) {
                        $role = $record->roles->first()?->name;
                        return $role ?? $record->role;
                    }),

                Tables\Columns\TextColumn::make('two_factor_status')
                    ->label('Two-factor')
                    ->getStateUsing(fn (User $record): string => $record->two_factor_confirmed_at ? 'On' : 'Off')
                    ->badge()
                    ->colors([
                        'success' => 'On',
                        'gray'    => 'Off',
                    ]),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => true,
                        'danger'  => false,
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('deactivate')
                    ->label(fn (User $record): string => $record->is_active ? 'Deactivate' : 'Activate')
                    ->color(fn (User $record): string => $record->is_active ? 'danger' : 'success')
                    ->icon(fn (User $record): string => $record->is_active ? 'heroicon-o-no-symbol' : 'heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        if ($record->is_active && $record->hasRole('Administrator')) {
                            if (User::countActiveAdministrators() <= 2) {
                                Notification::make()
                                    ->title('Action blocked')
                                    ->body('The system requires at least two active administrators. Cannot deactivate this administrator.')
                                    ->danger()
                                    ->send();
                                return;
                            }
                        }

                        $record->is_active = !$record->is_active;
                        $record->deactivated_at = $record->is_active ? null : now();
                        $record->save();

                        Notification::make()
                            ->title($record->is_active ? 'User activated' : 'User deactivated')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

