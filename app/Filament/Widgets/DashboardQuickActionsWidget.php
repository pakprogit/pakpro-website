<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DashboardQuickActionsWidget extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-quick-actions';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg'      => 3,
        'xl'      => 3,
    ];
}

