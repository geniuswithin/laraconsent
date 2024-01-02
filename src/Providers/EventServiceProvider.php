<?php

namespace Ekoukltd\LaraConsent\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        foreach (config('laraconsent.listeners', []) as $event => $listeners) {
            foreach ($listeners as $listener) {
                \Event::listen($event, $listener);
            }
        }
    }
}