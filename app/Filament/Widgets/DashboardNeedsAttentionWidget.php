<?php

namespace App\Filament\Widgets;

use App\Models\Highlight;
use App\Models\Price;
use App\Models\PricePublication;
use Filament\Widgets\Widget;

class DashboardNeedsAttentionWidget extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-needs-attention';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = [
        'default' => 12,
        'md' => 7,
        'xl' => 8,
    ];

    public function getAttentionItemsProperty(): array
    {
        $items = [];

        // Check 1: Prices older than 30 days or not set
        $lastPub = PricePublication::latest('published_at')->first();
        if (!$lastPub) {
            $items[] = [
                'type' => 'check',
                'text' => 'Last-updated date for prices is not set.',
                'link' => route('filament.admin.resources.prices.index'),
            ];
        } elseif (\Carbon\Carbon::parse($lastPub->published_at)->diffInDays(now()) > 30) {
            $items[] = [
                'type' => 'check',
                'text' => 'Prices were last updated more than 30 days ago.',
                'link' => route('filament.admin.resources.prices.index'),
            ];
        }

        // Check 2: PET strapping prices blank
        $petStrapping = Price::where('slug', 'pet-strapping')->orWhere('material', 'like', '%strapping%')->first();
        if ($petStrapping && is_null($petStrapping->recycler_min) && is_null($petStrapping->aggregator_min)) {
            $items[] = [
                'type' => 'check',
                'text' => 'PET strapping prices are blank. The site shows "To be confirmed".',
                'link' => route('filament.admin.resources.prices.index'),
            ];
        }

        // Check 3: Missing materials
        $missingPrices = Price::where('is_active', true)
            ->whereNull('recycler_min')
            ->where('slug', '!=', 'pet-strapping')
            ->count();
        if ($missingPrices > 0) {
            $items[] = [
                'type' => 'check',
                'text' => "{$missingPrices} material(s) have no price set.",
                'link' => route('filament.admin.resources.prices.index'),
            ];
        }

        // Check 4: Milk pouches confirmation
        $milkPouches = Price::where('slug', 'milk-pouches')->orWhere('material', 'like', '%milk%')->first();
        if ($milkPouches && $milkPouches->note) {
            $items[] = [
                'type' => 'check',
                'text' => 'Milk pouches match Monolayer flexibles exactly. Please confirm.',
                'link' => route('filament.admin.resources.prices.index'),
            ];
        }

        // Check 5: BCC or other highlight tabs empty this month
        $monthStart = now()->startOfMonth();
        $bccCount = Highlight::whereDate('month', $monthStart)->where('type', 'bcc')->where('status', 'published')->count();
        if ($bccCount === 0) {
            $items[] = [
                'type' => 'check',
                'text' => 'BCC Campaigns tab has no items for this month.',
                'link' => route('filament.admin.resources.highlights.index'),
            ];
        }

        $policyCount = Highlight::whereDate('month', $monthStart)->where('type', 'policy')->where('status', 'published')->count();
        if ($policyCount === 0) {
            $items[] = [
                'type' => 'check',
                'text' => 'Policy tab has no items for this month.',
                'link' => route('filament.admin.resources.highlights.index'),
            ];
        }

        $projectsCount = Highlight::whereDate('month', $monthStart)->where('type', 'projects')->where('status', 'published')->count();
        if ($projectsCount === 0) {
            $items[] = [
                'type' => 'check',
                'text' => 'Projects & Partnerships tab has no items for this month.',
                'link' => route('filament.admin.resources.highlights.index'),
            ];
        }

        return $items;
    }
}

