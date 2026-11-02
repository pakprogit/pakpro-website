<?php

namespace App\Observers;

use App\Models\Highlight;
use Illuminate\Support\Facades\Cache;

class HighlightObserver
{
    public function saved(Highlight $highlight): void
    {
        $this->clearCache($highlight);
    }

    public function deleted(Highlight $highlight): void
    {
        $this->clearCache($highlight);
    }

    protected function clearCache(Highlight $highlight): void
    {
        Cache::forget('homepage_data');
        Cache::forget("highlights_data_{$highlight->month_key}");
    }
}

