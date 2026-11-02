<?php

namespace App\Observers;

use App\Models\PricePublication;
use Illuminate\Support\Facades\Cache;

class PricePublicationObserver
{
    public function saved(PricePublication $publication): void
    {
        $this->clearCache();
    }

    public function deleted(PricePublication $publication): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('public_prices');
        Cache::forget('homepage_prices');
        Cache::forget('homepage_ticker');
        Cache::forget('prices_last_published');
        Cache::forget('homepage_data');
        Cache::flush();
    }
}
