<?php

namespace App\Console\Commands;

use App\Models\PricePublication;
use App\Models\User;
use App\Notifications\PriceStalertNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class CheckPricePublicationAge extends Command
{
    protected $signature = 'pakpro:check-prices';
    protected $description = 'Check if prices have not been published for over 30 days and alert administrators.';

    public function handle(): int
    {
        $lastPub = PricePublication::latest('published_at')->first();

        if (!$lastPub) {
            $this->warn('Prices have never been published!');
            return Command::SUCCESS;
        }

        $daysOld = Carbon::parse($lastPub->published_at)->diffInDays(now());

        if ($daysOld > 30) {
            $this->warn("Prices were published {$daysOld} days ago (exceeds 30 days threshold). Alerting administrators...");

            $admins = User::role('Administrator')->where('is_active', true)->get();
            if ($admins->isNotEmpty()) {
                Notification::send($admins, new PriceStalertNotification($daysOld));
            }
        } else {
            $this->info("Prices are up to date ({$daysOld} days old).");
        }

        return Command::SUCCESS;
    }
}

