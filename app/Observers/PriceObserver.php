<?php

namespace App\Observers;

use App\Models\Price;
use Illuminate\Support\Facades\Cache;

class PriceObserver
{
    public function saved(Price $price): void
    {
        $this->clearCache();
    }

    public function deleted(Price $price): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('homepage_prices');
        Cache::forget('homepage_ticker');
        Cache::forget('homepage_data');
    }
}

