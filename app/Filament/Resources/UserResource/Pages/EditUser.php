<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action) {
                    if ($this->record->hasRole('Administrator') && User::countActiveAdministrators() <= 2) {
                        Notification::make()
                            ->title('Cannot delete administrator')
                            ->body('The system requires at least two active administrators at all times.')
                            ->danger()
                            ->send();
                        $action->cancel();
                    }
                }),
        ];
    }

    protected function afterSave(): void
    {
        if (isset($this->data['role'])) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}

