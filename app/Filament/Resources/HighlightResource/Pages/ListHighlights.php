<?php

namespace App\Filament\Resources\HighlightResource\Pages;

use App\Filament\Resources\HighlightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListHighlights extends ListRecords
{
    protected static string $resource = HighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add highlight'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'policy' => Tab::make('Policy')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'policy')),
            'projects' => Tab::make('Projects & Partnerships')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'projects')),
            'bcc' => Tab::make('BCC Campaigns')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'bcc')),
        ];
    }
}

