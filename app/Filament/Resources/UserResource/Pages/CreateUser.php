<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['username'] = $data['username'] ?? explode('@', $data['email'])[0];
        $data['password_hash'] = bcrypt('TempPass123!');
        return $data;
    }

    protected function afterCreate(): void
    {
        if (isset($this->data['role'])) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}

