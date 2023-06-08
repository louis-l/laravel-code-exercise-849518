<?php

namespace App\Notifications;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCompanyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Company $company,
    ) {}

    public function via(Company $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Company $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('This is a notification when new company is entered.')
                    ->line(sprintf('New company name: %s', $notifiable->name))
                    ->action('View Company Details', route('companies.show', $notifiable))
                    ->line('Thank you for using our application!');
    }
}
