<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PriceStalertNotification extends Notification
{
    use Queueable;

    public function __construct(public int $daysOld)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('PAKPRO Action Required: Recycled Material Prices Outdated')
            ->greeting("Hello {$notifiable->name},")
            ->line("The recycled material prices published on the PAKPRO website are now {$this->daysOld} days old.")
            ->line('PAKPRO policy requires prices to be reviewed and re-published at least every 30 days.')
            ->action('Review Prices Now', url('/admin/prices'))
            ->line('Please review the current rates and publish an update.');
    }
}

