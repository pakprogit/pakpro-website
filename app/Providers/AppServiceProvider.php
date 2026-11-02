<?php

namespace App\Providers;

use App\Models\Highlight;
use App\Models\Price;
use App\Models\PricePublication;
use App\Models\SiteSetting;
use App\Observers\HighlightObserver;
use App\Observers\PriceObserver;
use App\Observers\PricePublicationObserver;
use App\Observers\SiteSettingObserver;
use App\Policies\AuditLogPolicy;
use App\Policies\FormSubmissionPolicy;
use App\Policies\HighlightPolicy;
use App\Policies\PricePolicy;
use App\Policies\SiteSettingPolicy;
use App\Policies\UserPolicy;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register Observers
        Price::observe(PriceObserver::class);
        PricePublication::observe(PricePublicationObserver::class);
        Highlight::observe(HighlightObserver::class);
        SiteSetting::observe(SiteSettingObserver::class);

        // Register Policies
        Gate::policy(Price::class, PricePolicy::class);
        Gate::policy(PricePublication::class, PricePolicy::class);
        Gate::policy(Highlight::class, HighlightPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(SiteSetting::class, SiteSettingPolicy::class);
        Gate::policy(FormSubmission::class, FormSubmissionPolicy::class);

        // Strong password defaults
        PasswordRule::defaults(function () {
            return PasswordRule::min(12)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
