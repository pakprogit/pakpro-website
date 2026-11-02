<?php

namespace App\Filament\Widgets;

use App\Models\Price;
use App\Models\PricePublication;
use Filament\Widgets\Widget;

class PriceHistoryWidget extends Widget
{
    protected static string $view = 'filament.widgets.price-history-widget';
    protected int | string | array $columnSpan = 'full';

    public function getLatestPublicationProperty()
    {
        return PricePublication::with('user')->latest('published_at')->first();
    }

    public function getRecentPublicationsProperty()
    {
        return PricePublication::with('user')->latest('published_at')->take(5)->get();
    }

    public function getCheckListProperty(): array
    {
        $hasErrors = false;
        $items = [];

        // Check 1: min must not exceed max
        $invalidRange = Price::whereNotNull('recycler_min')
            ->whereNotNull('recycler_max')
            ->whereRaw('recycler_min > recycler_max')
            ->count();
        if ($invalidRange > 0) {
            $items[] = ['status' => 'error', 'text' => "{$invalidRange} material has min exceeding max!"];
        } else {
            $items[] = ['status' => 'ok', 'text' => 'Minimum must not exceed maximum'];
        }

        // Check 2: missing price
        $missing = Price::where('is_active', true)
            ->whereNull('recycler_min')
            ->whereNull('aggregator_min')
            ->count();
        if ($missing > 0) {
            $items[] = ['status' => 'warning', 'text' => "{$missing} material has no price (shows 'To be confirmed')"];
        }

        // Check 3: needs confirming
        $needsConfirm = Price::where('is_active', true)
            ->whereNotNull('note')
            ->count();
        if ($needsConfirm > 0) {
            $items[] = ['status' => 'warning', 'text' => "{$needsConfirm} material needs confirming"];
        }

        return $items;
    }
}

