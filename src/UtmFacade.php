<?php

namespace Astrogoat\Utm;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Utm\Utm
 */
class UtmFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'utm';
    }
}
