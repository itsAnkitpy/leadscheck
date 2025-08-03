<?php

namespace App\Listeners;

use Stancl\Tenancy\Events\TenancyInitialized;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckTenantStatus
{
    /**
     * Handle the event.
     */
    public function handle(TenancyInitialized $event): void
    {
        if ($event->tenancy->tenant->status === 'suspended') {
            throw new HttpException(403, 'This account is suspended.');
        }
    }
}
