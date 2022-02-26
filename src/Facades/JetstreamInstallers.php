<?php

namespace HeaderX\JetstreamInstallers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HeaderX\JetstreamInstallers\JetstreamInstallers
 */
class JetstreamInstallers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-jetstream-installers';
    }
}
