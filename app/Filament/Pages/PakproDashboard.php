<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardNeedsAttentionWidget;
use App\Filament\Widgets\DashboardQuickActionsWidget;
use App\Filament\Widgets\DashboardRecentChangesWidget;
use App\Filament\Widgets\DashboardStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class PakproDashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public function getSubheading(): ?string
    {
        $name = auth()->user()?->name ?? 'User';
        return "Good day, {$name}. Anything you save here goes live on the website straight away.";
    }

    public function getWidgets(): array
    {
        return [
            DashboardStatsWidget::class,
            DashboardNeedsAttentionWidget::class,
            DashboardQuickActionsWidget::class,
            DashboardRecentChangesWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 12;
    }
}

