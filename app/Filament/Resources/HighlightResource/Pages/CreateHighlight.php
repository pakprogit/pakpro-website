<?php

namespace App\Filament\Resources\HighlightResource\Pages;

use App\Filament\Resources\HighlightResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateHighlight extends CreateRecord
{
    protected static string $resource = HighlightResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        if (($data['status'] ?? 'draft') === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
        return $data;
    }
}

