<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Spatie\Activitylog\Models\Activity;

class DashboardRecentChangesWidget extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-recent-changes';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg'      => 4,
        'xl'      => 4,
    ];

    public function getRecentChangesProperty()
    {
        return Activity::with('causer')
            ->latest()
            ->take(6)
            ->get();
    }
}

