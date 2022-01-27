<?php

namespace Ekoukltd\LaraConsent\Listeners;

use Ekoukltd\LaraConsent\Events\ConsentUpdated;
use Ekoukltd\LaraConsent\Events\ConsentsUpdatedComplete;
use Ekoukltd\LaraConsent\Notifications\ConsentsUpdatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotifyConsentsUpdated
{
    public function handle(ConsentsUpdatedComplete $event)
    {
        $event->user->notify(new ConsentsUpdatedNotification());
    }
    
}