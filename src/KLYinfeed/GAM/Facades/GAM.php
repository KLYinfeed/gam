<?php

namespace KLYinfeed\GAM\Facades;

use Illuminate\Support\Facades\Facade;
use KLYinfeed\GAM\Contracts\Factory;

/**
 * @see \KLYinfeed\GAM\GAM
 */
class GAM extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}
