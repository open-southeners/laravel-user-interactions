<?php

namespace OpenSoutheners\LaravelUserInteractions\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \OpenSoutheners\LaravelUserInteractions\Support\Interaction
 */
class Interaction extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'user.interaction';
    }
}
