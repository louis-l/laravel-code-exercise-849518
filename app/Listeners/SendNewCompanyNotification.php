<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Notifications\NewCompanyNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewCompanyNotification implements ShouldQueue
{
    public function handle(CompanyCreated $event): void
    {
        $event->company->notify(
            new NewCompanyNotification($event->company)
        );
    }
}
