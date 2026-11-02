<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('invite_user')
                ->label('Invite user')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->form([
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->label('Email address'),
                    Forms\Components\Select::make('role')
                        ->options([
                            'Administrator' => 'Administrator',
                            'Communications editor' => 'Communications editor',
                            'Price editor' => 'Price editor',
                        ])
                        ->default('Communications editor')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $token = Str::random(40);
                    $user = User::updateOrCreate(
                        ['email' => $data['email']],
                        [
                            'name' => explode('@', $data['email'])[0],
                            'username' => explode('@', $data['email'])[0],
                            'password_hash' => bcrypt(Str::random(16)),
                            'role' => $data['role'],
                            'is_active' => true,
                            'invitation_token' => $token,
                            'invitation_expires_at' => now()->addHours(48),
                        ]
                    );

                    $user->syncRoles([$data['role']]);

                    $inviteUrl = url("/invitation/{$token}");

                    Notification::make()
                        ->title('Invitation sent!')
                        ->body("Invitation link for {$data['email']}: {$inviteUrl}")
                        ->success()
                        ->send();
                }),
            Actions\CreateAction::make()->label('Add user manually'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\UserRoleMatrixWidget::class,
        ];
    }
}

