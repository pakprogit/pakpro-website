<?php

namespace App\Observers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingObserver
{
    public function saved(SiteSetting $setting): void
    {
        $this->clearCache($setting);
    }

    public function deleted(SiteSetting $setting): void
    {
        $this->clearCache($setting);
    }

    protected function clearCache(SiteSetting $setting): void
    {
        Cache::forget("site_setting_{$setting->key}");
        Cache::forget('homepage_data');
    }
}

