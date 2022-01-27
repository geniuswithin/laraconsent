<?php

namespace Ekoukltd\LaraConsent\Facades;

use Illuminate\Support\Facades\Facade;

class LaraConsent extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laraconsent';
    }
}
