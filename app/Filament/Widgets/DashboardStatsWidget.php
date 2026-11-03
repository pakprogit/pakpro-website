<?php

namespace App\Filament\Widgets;

use App\Models\FormSubmission;
use App\Models\Highlight;
use App\Models\PricePublication;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $lastPub = PricePublication::latest('published_at')->first();
        $pricesDate = $lastPub ? Carbon::parse($lastPub->published_at)->format('d M Y') : 'Not set';
        
        $monthStart = now()->startOfMonth();
        $highlightsCount = Highlight::whereDate('month', $monthStart)->where('status', 'published')->count();
        $policyCount = Highlight::whereDate('month', $monthStart)->where('type', 'policy')->where('status', 'published')->count();
        $projectsCount = Highlight::whereDate('month', $monthStart)->where('type', 'projects')->where('status', 'published')->count();
        $bccCount = Highlight::whereDate('month', $monthStart)->where('type', 'bcc')->where('status', 'published')->count();

        $formsWaiting = FormSubmission::where('status', 'pending')->count();
        $activeUsers = User::where('is_active', true)->count();

        return [
            Stat::make('Prices last updated', $pricesDate)
                ->description('Reminder after 30 days')
                ->descriptionIcon('heroicon-m-clock')
                ->color($lastPub && Carbon::parse($lastPub->published_at)->diffInDays(now()) > 30 ? 'danger' : 'gray'),

            Stat::make('Highlights this month', "{$highlightsCount} items")
                ->description("{$policyCount} Policy · {$projectsCount} Projects · {$bccCount} BCC")
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('primary'),

            Stat::make('Forms waiting', (string)$formsWaiting)
                ->description('Enquiries and registrations')
                ->descriptionIcon('heroicon-m-inbox')
                ->color($formsWaiting > 0 ? 'warning' : 'gray'),

            Stat::make('Active users', (string)$activeUsers)
                ->description('Added by administrators')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
        ];
    }
}

