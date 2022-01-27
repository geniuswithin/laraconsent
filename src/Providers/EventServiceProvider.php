<?php

namespace Ekoukltd\LaraConsent\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Ekoukltd\LaraConsent\Events\ConsentsUpdatedComplete;
use Ekoukltd\LaraConsent\Listeners\NotifyConsentsUpdated;
use Ekoukltd\LaraConsent\Events\ConsentUpdated;
use Ekoukltd\LaraConsent\Listeners\LogConsentUpdated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        //Triggered after each consent option is saved.
        ConsentUpdated::class => [
            LogConsentUpdated::class,
            //Add update mailchimp subscription event here
        ],
        //Triggered after all consent options have been saved
        ConsentsUpdatedComplete::class => [
            //Sends email to user with copy of the consents
            NotifyConsentsUpdated::class
        ]
    ];
    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}